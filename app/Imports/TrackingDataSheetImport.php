<?php

namespace App\Imports;

use App\Models\Tracking;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Illuminate\Support\Str;

class TrackingDataSheetImport implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    private $rowCount = 0, $importedCount = 0, $failedRows = [], $defaultType, $defaultShipmentType;

    public function setDefaultType($t)
    {
        $this->defaultType = $t;
    }
    public function setDefaultShipmentType($s)
    {
        $this->defaultShipmentType = $s;
    }

    public function model(array $row)
    {
        $this->rowCount++;
        $bl = isset($row['bl_number']) ? trim((string)$row['bl_number']) : '';
        if (empty($bl)) return null;

        try {
            $tracking = Tracking::updateOrCreate(
                ['bl_number' => $bl],
                [
                    'type'              => Str::title($row['type'] ?? $this->defaultType ?? 'Export'),
                    'shipper'           => $row['shipper'],
                    'consignee'         => $row['consignee'],
                    'origin'            => $row['origin'],
                    'destination'       => $row['destination'],
                    'shipment_type'     => strtoupper($row['shipment_type'] ?? $this->defaultShipmentType ?? 'LCL'),
                    'total_measurement' => $row['total_measurement'],
                    'total_packages'    => $row['total_packages'],
                    'container_number'  => $row['container_number'],
                    'size_type'         => $row['size_type'],
                    'vessel_voyage'     => $row['vessel_voyage'],
                ]
            );
            $this->importedCount++;
            return $tracking;
        } catch (\Exception $e) {
            $this->failedRows[$this->rowCount] = "Sheet Data: " . $e->getMessage();
            return null;
        }
    }

    public function getRowCount() { return $this->rowCount; }
    public function getImportedCount() { return $this->importedCount; }
    public function getFailedRows() { return $this->failedRows; }
}
