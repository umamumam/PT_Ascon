<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TrackingImport implements WithMultipleSheets
{
    private $defaultType;
    private $defaultShipmentType;
    private $dataSheet;
    private $detailSheet;

    public function __construct() {
        $this->dataSheet = new TrackingDataSheetImport();
        $this->detailSheet = new TrackingDetailSheetImport();
    }

    public function sheets(): array {
        return [
            'Data Tracking'   => $this->dataSheet,
            'Detail Tracking' => $this->detailSheet,
        ];
    }

    public function setDefaultType($type) { $this->dataSheet->setDefaultType($type); }
    public function setDefaultShipmentType($st) { $this->dataSheet->setDefaultShipmentType($st); }
    public function getRowCount() { return $this->dataSheet->getRowCount(); }
    public function getImportedCount() { return $this->dataSheet->getImportedCount(); }
    public function getFailedRows() {
        return array_merge($this->dataSheet->getFailedRows(), $this->detailSheet->getFailedRows());
    }
}
