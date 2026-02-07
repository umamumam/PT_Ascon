<?php

namespace App\Exports;

use Barryvdh\DomPDF\Facade\Pdf;

class SailingSchedulePdfExport
{
    protected $groupedSchedules;
    protected $columnsPerRoute;
    protected $type;
    protected $service;
    protected $polName;
    protected $podName;
    protected $polCode;
    protected $podCode;

    public function __construct(
        $groupedSchedules,
        $columnsPerRoute,
        $type,
        $service,
        $polName = null,
        $podName = null,
        $polCode = null,
        $podCode = null
    ) {
        $this->groupedSchedules = $groupedSchedules;
        $this->columnsPerRoute = $columnsPerRoute;
        $this->type = $type;
        $this->service = $service;
        $this->polName = $polName;
        $this->podName = $podName;
        $this->polCode = $polCode;
        $this->podCode = $podCode;
    }

    public function download()
    {
        $data = [
            'groupedSchedules' => $this->groupedSchedules,
            'columnsPerRoute' => $this->columnsPerRoute,
            'type' => $this->type,
            'service' => $this->service,
            'polName' => $this->polName,
            'podName' => $this->podName,
            'polCode' => $this->polCode,
            'podCode' => $this->podCode,
            'generatedDate' => now()->format('F Y'),
            'generatedDateFull' => now()->format('d F Y'),
        ];

        $pdf = Pdf::loadView('exports.sailing-schedule-pdf', $data);
        $pdf->setPaper('a4', 'landscape');

        // Stream untuk preview di browser (bukan download langsung)
        return $pdf->stream($this->generateFilename());
    }

    protected function generateFilename()
    {
        $parts = ['Sailing_Schedule', $this->type, $this->service];

        if ($this->polName) {
            $parts[] = str_replace(' ', '_', $this->polName);
        }

        if ($this->podName) {
            $parts[] = 'to';
            $parts[] = str_replace(' ', '_', $this->podName);
        }

        $parts[] = now()->format('Y-m-d');

        return implode('_', $parts) . '.pdf';
    }
}
