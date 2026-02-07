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
            // Handle bl_number - pastikan selalu string, bahkan jika berupa angka
            $blNumber = $this->formatBlNumber($row['bl_number'] ?? '');

            if (empty($blNumber)) {
                throw new \Exception("BL Number tidak boleh kosong");
            }

            // Cek duplikasi bl_number
            if (Tracking::where('bl_number', $blNumber)->exists()) {
                throw new \Exception("BL Number '{$blNumber}' sudah ada di database");
            }

            // Type: gunakan default jika kosong
            $type = !empty(trim($row['type'] ?? ''))
                ? Str::title(trim($row['type']))
                : $this->defaultType;

            // Shipment Type: gunakan default jika kosong
            $shipmentType = !empty(trim($row['shipment_type'] ?? ''))
                ? strtoupper(trim($row['shipment_type']))
                : $this->defaultShipmentType;

            // Validasi enum values
            if (!in_array($type, ['Export', 'Import'])) {
                $type = $this->defaultType ?? 'Export';
            }
            if (!in_array($shipmentType, ['LCL', 'FCL'])) {
                $shipmentType = $this->defaultShipmentType ?? 'LCL';
            }

            // Validasi field wajib
            $requiredFields = [
                'shipper' => 'Shipper',
                'consignee' => 'Consignee',
                'origin' => 'Origin',
                'destination' => 'Destination',
                'vessel_voyage' => 'Vessel/Voyage',
                'etd' => 'ETD',
                'eta' => 'ETA',
            ];

            foreach ($requiredFields as $field => $label) {
                if (empty(trim($row[$field] ?? ''))) {
                    throw new \Exception("{$label} tidak boleh kosong");
                }
            }

            $tracking = new Tracking([
                'bl_number'         => $blNumber,
                'type'              => $type,
                'shipment_type'     => $shipmentType,
                'shipper'           => trim($row['shipper'] ?? ''),
                'consignee'         => trim($row['consignee'] ?? ''),
                'origin'            => trim($row['origin'] ?? ''),
                'destination'       => trim($row['destination'] ?? ''),
                'total_measurement' => trim($row['total_measurement'] ?? null),
                'total_packages'    => trim($row['total_packages'] ?? null),
                'container_number'  => trim($row['container_number'] ?? null),
                'size_type'         => trim($row['size_type'] ?? null),
                'vessel_voyage'     => trim($row['vessel_voyage'] ?? ''),
                'etd'               => $this->parseDate($row['etd'] ?? null),
                'eta'               => $this->parseDate($row['eta'] ?? null),
                'connecting_vessel' => trim($row['connecting_vessel'] ?? null),
                'connecting_etd'    => $this->parseDate($row['connecting_etd'] ?? null),
                'connecting_eta'    => $this->parseDate($row['connecting_eta'] ?? null),
                'remarks'           => trim($row['remarks'] ?? null),
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
            $row = $failure->row();
            $errors = implode(', ', $failure->errors());
            $this->failedRows[$row] = $errors;
        }
    }

    /**
     * Format BL Number - pastikan selalu string
     * Menangani kasus ketika Excel mengubah angka menjadi numeric
     */
    private function formatBlNumber($value)
    {
        if (empty($value)) {
            return '';
        }

        // Jika berupa angka (numeric atau float), konversi ke string
        if (is_numeric($value)) {
            // Hapus desimal .0 jika ada (dari Excel)
            $value = rtrim(rtrim(number_format($value, 10, '.', ''), '0'), '.');
        }

        // Konversi ke string dan trim
        return (string) trim($value);
    }

    /**
     * Parse date dari berbagai format
     */
    private function parseDate($date)
    {
        if (empty($date)) {
            return null;
        }

        try {
            // Jika numeric (Excel date format)
            if (is_numeric($date)) {
                return Carbon::instance(
                    \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date)
                )->format('Y-m-d');
            }

            // Parse string date
            return Carbon::parse($date)->format('Y-m-d');
        } catch (\Exception $e) {
            throw new \Exception("Format tanggal tidak valid: {$date}");
        }
    }

    /**
     * Get total rows processed
     */
    public function getRowCount(): int
    {
        return $this->rowCount;
    }

    /**
     * Get successfully imported count
     */
    public function getImportedCount(): int
    {
        return $this->importedCount;
    }

    /**
     * Get failed rows with error messages
     */
    public function getFailedRows(): array
    {
        return $this->failedRows;
    }
}
