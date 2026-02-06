<?php

namespace App\Imports;

use App\Models\Tracking;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Illuminate\Validation\Rule;

class TrackingImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, SkipsEmptyRows, WithBatchInserts
{
    use SkipsFailures, Importable;

    private $rowCount = 0;
    private $importedCount = 0;
    private $failedRows = [];
    private $defaultType = null;
    private $defaultShipmentType = null;
    private $existingBlNumbers = [];

    public function __construct()
    {
        // Pre-load existing BL numbers untuk cek duplikasi
        $this->existingBlNumbers = Tracking::pluck('bl_number')->toArray();
    }

    public function setDefaultType($type)
    {
        $this->defaultType = $type;
    }

    public function setDefaultShipmentType($shipmentType)
    {
        $this->defaultShipmentType = $shipmentType;
    }

    public function getRowCount()
    {
        return $this->rowCount;
    }

    public function getImportedCount()
    {
        return $this->importedCount;
    }

    public function getFailedRows()
    {
        return $this->failedRows;
    }

    public function model(array $row)
    {
        $this->rowCount++;

        // Clean BL Number
        $blNumber = $this->cleanValue($row['bl_number'] ?? '');

        // Validasi BL Number tidak kosong
        if (empty($blNumber)) {
            $this->failedRows[$this->rowCount] = "BL Number tidak boleh kosong";
            return null;
        }

        // Cek duplikasi dalam file import
        static $importedBlNumbers = [];
        if (in_array($blNumber, $importedBlNumbers)) {
            $this->failedRows[$this->rowCount] = "BL Number '{$blNumber}' duplikat dalam file import";
            return null;
        }

        // Cek duplikasi dengan database
        if (in_array($blNumber, $this->existingBlNumbers)) {
            $this->failedRows[$this->rowCount] = "BL Number '{$blNumber}' sudah terdaftar di database";
            return null;
        }

        $importedBlNumbers[] = $blNumber;

        // Set default values
        $type = !empty($row['type']) ? $this->cleanValue($row['type']) : $this->defaultType;
        $shipmentType = !empty($row['shipment_type']) ? $this->cleanValue($row['shipment_type']) : $this->defaultShipmentType;

        // Validate required fields
        if (empty($type)) {
            $this->failedRows[$this->rowCount] = "Type tidak boleh kosong";
            return null;
        }

        if (empty($shipmentType)) {
            $this->failedRows[$this->rowCount] = "Shipment Type tidak boleh kosong";
            return null;
        }

        if (!in_array($type, ['Export', 'Import'])) {
            $this->failedRows[$this->rowCount] = "Type '{$type}' tidak valid. Harus Export atau Import";
            return null;
        }

        if (!in_array($shipmentType, ['LCL', 'FCL'])) {
            $this->failedRows[$this->rowCount] = "Shipment Type '{$shipmentType}' tidak valid. Harus LCL atau FCL";
            return null;
        }

        // Validate dates
        $etd = $this->formatDate($row['etd'] ?? null);
        $eta = $this->formatDate($row['eta'] ?? null);

        if (!$etd) {
            $this->failedRows[$this->rowCount] = "ETD tidak valid atau kosong";
            return null;
        }

        if (!$eta) {
            $this->failedRows[$this->rowCount] = "ETA tidak valid atau kosong";
            return null;
        }

        // Set FCL/LCL specific fields - HANYA string tanpa validasi numerik
        $containerNumber = null;
        $sizeType = null;
        $totalMeasurement = null;
        $totalPackages = null;

        if ($shipmentType === 'FCL') {
            $containerNumber = $this->cleanValue($row['container_number'] ?? null);
            $sizeType = $this->cleanValue($row['size_type'] ?? null);
        } elseif ($shipmentType === 'LCL') {
            $totalMeasurement = $this->cleanValue($row['total_measurement'] ?? null);
            $totalPackages = $this->cleanValue($row['total_packages'] ?? null);
        }

        // Tambahkan ke existing BL numbers untuk cek duplikasi berikutnya
        $this->existingBlNumbers[] = $blNumber;
        $this->importedCount++;

        return new Tracking([
            'bl_number' => $blNumber,
            'type' => $type,
            'shipment_type' => $shipmentType,
            'shipper' => $this->cleanValue($row['shipper']),
            'consignee' => $this->cleanValue($row['consignee']),
            'origin' => $this->cleanValue($row['origin']),
            'destination' => $this->cleanValue($row['destination']),
            'total_measurement' => $totalMeasurement,
            'total_packages' => $totalPackages,
            'container_number' => $containerNumber,
            'size_type' => $sizeType,
            'vessel_voyage' => $this->cleanValue($row['vessel_voyage']),
            'etd' => $etd,
            'eta' => $eta,
            'connecting_vessel' => $this->cleanValue($row['connecting_vessel'] ?? null),
            'connecting_etd' => $this->formatDate($row['connecting_etd'] ?? null),
            'connecting_eta' => $this->formatDate($row['connecting_eta'] ?? null),
            'remarks' => $this->cleanValue($row['remarks'] ?? null),
        ]);
    }

    private function cleanValue($value)
    {
        if (is_null($value) || $value === '' || $value === []) {
            return null;
        }

        // Jika numeric, convert ke string
        if (is_numeric($value)) {
            return (string) $value;
        }

        // Jika array, ambil nilai pertama
        if (is_array($value)) {
            $value = $value[0] ?? null;
        }

        if (is_string($value)) {
            $value = trim($value);
            // Hilangkan karakter yang tidak perlu
            $value = preg_replace('/[^\x20-\x7E\xA0-\xFF]/', '', $value);
            return $value === '' ? null : $value;
        }

        // Untuk tipe data lainnya, convert ke string
        return (string) $value;
    }

    private function formatDate($date)
    {
        if (empty($date)) {
            return null;
        }

        try {
            // Jika sudah Carbon instance
            if ($date instanceof \Carbon\Carbon) {
                return $date;
            }

            // Jika string
            if (is_string($date)) {
                $date = trim($date);

                // Coba berbagai format
                $formats = [
                    'Y-m-d',
                    'd/m/Y',
                    'd-m-Y',
                    'm/d/Y',
                    'Y/m/d',
                    'd M Y',
                    'd F Y',
                ];

                foreach ($formats as $format) {
                    try {
                        $parsedDate = \Carbon\Carbon::createFromFormat($format, $date);
                        if ($parsedDate !== false) {
                            return $parsedDate;
                        }
                    } catch (\Exception $e) {
                        continue;
                    }
                }

                // Coba parse secara general
                return \Carbon\Carbon::parse($date);
            }

            // Jika numeric (Excel timestamp)
            if (is_numeric($date)) {
                try {
                    return \Carbon\Carbon::instance(
                        \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date)
                    );
                } catch (\Exception $e) {
                    // Jika gagal, coba sebagai timestamp Unix
                    if ($date > 100000) { // Anggap sebagai timestamp Excel
                        return \Carbon\Carbon::createFromTimestamp(
                            ($date - 25569) * 86400 // Convert Excel date to Unix timestamp
                        );
                    }
                    return \Carbon\Carbon::createFromTimestamp($date);
                }
            }

            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function rules(): array
    {
        return [
            'bl_number' => [
                'required',
                function ($attribute, $value, $fail) {
                    $blNumber = $this->cleanValue($value);

                    if (empty($blNumber)) {
                        $fail('BL Number tidak boleh kosong');
                        return;
                    }

                    if (strlen($blNumber) > 100) {
                        $fail('BL Number maksimal 100 karakter');
                    }
                }
            ],
            'type' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    $type = $this->cleanValue($value);
                    if (!empty($type) && !in_array($type, ['Export', 'Import'])) {
                        $fail('Type harus Export atau Import');
                    }
                }
            ],
            'shipment_type' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    $shipmentType = $this->cleanValue($value);
                    if (!empty($shipmentType) && !in_array($shipmentType, ['LCL', 'FCL'])) {
                        $fail('Shipment Type harus LCL atau FCL');
                    }
                }
            ],
            'shipper' => [
                'required',
                function ($attribute, $value, $fail) {
                    $shipper = $this->cleanValue($value);
                    if (empty($shipper)) {
                        $fail('Shipper wajib diisi');
                    }
                    if (strlen($shipper) > 255) {
                        $fail('Shipper maksimal 255 karakter');
                    }
                }
            ],
            'consignee' => [
                'required',
                function ($attribute, $value, $fail) {
                    $consignee = $this->cleanValue($value);
                    if (empty($consignee)) {
                        $fail('Consignee wajib diisi');
                    }
                    if (strlen($consignee) > 255) {
                        $fail('Consignee maksimal 255 karakter');
                    }
                }
            ],
            'origin' => [
                'required',
                function ($attribute, $value, $fail) {
                    $origin = $this->cleanValue($value);
                    if (empty($origin)) {
                        $fail('Origin wajib diisi');
                    }
                    if (strlen($origin) > 100) {
                        $fail('Origin maksimal 100 karakter');
                    }
                }
            ],
            'destination' => [
                'required',
                function ($attribute, $value, $fail) {
                    $destination = $this->cleanValue($value);
                    if (empty($destination)) {
                        $fail('Destination wajib diisi');
                    }
                    if (strlen($destination) > 100) {
                        $fail('Destination maksimal 100 karakter');
                    }
                }
            ],
            'total_measurement' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    // Tidak ada validasi khusus, hanya sebagai string
                }
            ],
            'total_packages' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    // Tidak ada validasi khusus, hanya sebagai string
                }
            ],
            'container_number' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    // Tidak ada validasi khusus, hanya sebagai string
                }
            ],
            'size_type' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    // Tidak ada validasi khusus, hanya sebagai string
                }
            ],
            'vessel_voyage' => [
                'required',
                function ($attribute, $value, $fail) {
                    $vesselVoyage = $this->cleanValue($value);
                    if (empty($vesselVoyage)) {
                        $fail('Vessel/Voyage wajib diisi');
                    }
                    if (strlen($vesselVoyage) > 100) {
                        $fail('Vessel/Voyage maksimal 100 karakter');
                    }
                }
            ],
            'etd' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (empty($value)) {
                        $fail('ETD wajib diisi');
                        return;
                    }

                    if (!$this->formatDate($value)) {
                        $fail('Format ETD tidak valid');
                    }
                }
            ],
            'eta' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (empty($value)) {
                        $fail('ETA wajib diisi');
                        return;
                    }

                    if (!$this->formatDate($value)) {
                        $fail('Format ETA tidak valid');
                    }
                }
            ],
        ];
    }

    public function customValidationMessages()
    {
        return [
            'bl_number.required' => 'BL Number wajib diisi',
            'shipper.required' => 'Shipper wajib diisi',
            'consignee.required' => 'Consignee wajib diisi',
            'origin.required' => 'Origin wajib diisi',
            'destination.required' => 'Destination wajib diisi',
            'vessel_voyage.required' => 'Vessel/Voyage wajib diisi',
            'etd.required' => 'ETD wajib diisi',
            'eta.required' => 'ETA wajib diisi',
        ];
    }

    public function prepareForValidation($data, $index)
    {
        foreach ($data as $key => $value) {
            if (is_string($value) || is_numeric($value)) {
                $data[$key] = $this->cleanValue($value);
            }
        }

        return $data;
    }

    public function batchSize(): int
    {
        return 100;
    }
}
