<?php

namespace App\Imports;

use App\Models\Tracking;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TrackingImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    private $defaultType = null;
    private $defaultShipmentType = null;
    private $rowCount = 0;
    private $importedCount = 0;
    private $failedRows = [];

    public function setDefaultType($type)
    {
        $this->defaultType = $type;
    }

    public function setDefaultShipmentType($shipmentType)
    {
        $this->defaultShipmentType = $shipmentType;
    }

    public function model(array $row)
    {
        $this->rowCount++;

        try {
            $blNumber = $this->formatBlNumber($row['bl_number'] ?? '');

            if (empty($blNumber)) {
                throw new \Exception("BL Number tidak boleh kosong");
            }

            if (Tracking::where('bl_number', $blNumber)->exists()) {
                throw new \Exception("BL Number '{$blNumber}' sudah ada di database");
            }

            $type = !empty(trim($row['type'] ?? ''))
                ? Str::title(trim($row['type']))
                : $this->defaultType;

            $shipmentType = !empty(trim($row['shipment_type'] ?? ''))
                ? strtoupper(trim($row['shipment_type']))
                : $this->defaultShipmentType;

            if (!in_array($type, ['Export', 'Import'])) {
                $type = $this->defaultType ?? 'Export';
            }

            if (!in_array($shipmentType, ['LCL', 'FCL'])) {
                $shipmentType = $this->defaultShipmentType ?? 'LCL';
            }

            $requiredFields = [
                'shipper'       => 'Shipper',
                'consignee'     => 'Consignee',
                'origin'        => 'Origin',
                'destination'   => 'Destination',
                'vessel_voyage' => 'Vessel/Voyage',
                'etd'           => 'ETD',
                'eta'           => 'ETA',
            ];

            foreach ($requiredFields as $field => $label) {
                if (empty(trim($row[$field] ?? ''))) {
                    throw new \Exception("{$label} tidak boleh kosong");
                }
            }

            $tracking = new Tracking([
                'bl_number'          => $blNumber,
                'type'               => $type,
                'shipment_type'      => $shipmentType,
                'shipper'            => trim($row['shipper'] ?? ''),
                'consignee'          => trim($row['consignee'] ?? ''),
                'origin'             => trim($row['origin'] ?? ''),
                'destination'        => trim($row['destination'] ?? ''),
                'total_measurement'  => trim($row['total_measurement'] ?? '') ?: null,
                'total_packages'     => trim($row['total_packages'] ?? '') ?: null,
                'container_number'   => trim($row['container_number'] ?? '') ?: null,
                'size_type'          => trim($row['size_type'] ?? '') ?: null,
                'vessel_voyage'      => trim($row['vessel_voyage'] ?? ''),
                'etd'                => $this->parseDate($row['etd'] ?? null),
                'eta'                => $this->parseDate($row['eta'] ?? null),
                'connecting_vessel1' => trim($row['connecting_vessel1'] ?? '') ?: null,
                'connecting_etd1'    => $this->parseDate($row['connecting_etd1'] ?? null),
                'connecting_eta1'    => $this->parseDate($row['connecting_eta1'] ?? null),
                'connecting_vessel2' => trim($row['connecting_vessel2'] ?? '') ?: null,
                'connecting_etd2'    => $this->parseDate($row['connecting_etd2'] ?? null),
                'connecting_eta2'    => $this->parseDate($row['connecting_eta2'] ?? null),
                'connecting_vessel3' => trim($row['connecting_vessel3'] ?? '') ?: null,
                'connecting_etd3'    => $this->parseDate($row['connecting_etd3'] ?? null),
                'connecting_eta3'    => $this->parseDate($row['connecting_eta3'] ?? null),
                'remarks'            => trim($row['remarks'] ?? '') ?: null,
            ]);

            $this->importedCount++;
            return $tracking;

        } catch (\Exception $e) {
            $this->failedRows[$this->rowCount + 1] = $e->getMessage();
            return null;
        }
    }

    public function rules(): array
    {
        return [
            'bl_number'     => 'required',
            'shipper'       => 'required',
            'consignee'     => 'required',
            'origin'        => 'required',
            'destination'   => 'required',
            'vessel_voyage' => 'required',
            'etd'           => 'required',
            'eta'           => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'bl_number.required'     => 'BL Number wajib diisi',
            'shipper.required'       => 'Shipper wajib diisi',
            'consignee.required'     => 'Consignee wajib diisi',
            'origin.required'        => 'Origin wajib diisi',
            'destination.required'   => 'Destination wajib diisi',
            'vessel_voyage.required' => 'Vessel/Voyage wajib diisi',
            'etd.required'           => 'ETD wajib diisi',
            'eta.required'           => 'ETA wajib diisi',
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        foreach ($failures as $failure) {
            $row    = $failure->row();
            $blNumber = $failure->values()['bl_number'] ?? 'N/A';
            $errors = implode(', ', $failure->errors());
            $this->failedRows[$row] = "BL: {$blNumber} - {$errors}";
        }
    }

    private function formatBlNumber($value)
    {
        if (empty($value)) {
            return '';
        }

        if (is_numeric($value)) {
            $value = rtrim(rtrim(number_format($value, 10, '.', ''), '0'), '.');
        }

        return (string) trim($value);
    }

    private function parseDate($date)
    {
        if (empty($date)) {
            return null;
        }

        try {
            if (is_numeric($date)) {
                return Carbon::instance(
                    \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date)
                )->format('Y-m-d');
            }

            return Carbon::parse($date)->format('Y-m-d');
        } catch (\Exception $e) {
            throw new \Exception("Format tanggal tidak valid: {$date}");
        }
    }

    public function getRowCount(): int
    {
        return $this->rowCount;
    }

    public function getImportedCount(): int
    {
        return $this->importedCount;
    }

    public function getFailedRows(): array
    {
        return $this->failedRows;
    }
}
