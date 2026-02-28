<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TrackingTemplateExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new TrackingDataSheet(),
            new TrackingDetailSheet(),
        ];
    }
}
