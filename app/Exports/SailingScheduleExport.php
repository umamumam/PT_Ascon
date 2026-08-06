<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class SailingScheduleExport implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize, WithColumnWidths, WithStyles
{
    protected $schedules;

    public function __construct($schedules)
    {
        $this->schedules = $schedules;
    }

    public function collection()
    {
        return $this->schedules;
    }

    public function map($schedule): array
    {
        return [
            $schedule->type,
            $schedule->service,
            $schedule->pol->port_name ?? '',
            $schedule->pod->port_name ?? '',
            $schedule->vessel,
            $schedule->voyage,
            $schedule->etd,
            $schedule->eta_destination,
            $schedule->eta_code_connecting,
            $schedule->eta_destination1,
            $schedule->eta_destination2,
            $schedule->eta_destination3,
            $schedule->eta_destination4,
            $schedule->eta_destination5,
            $schedule->eta_destination6,
            $schedule->eta_destination7,
            $schedule->eta_text,
            $schedule->connecting_vessel,
            $schedule->connecting_voyage,
            $schedule->connecting_etd,
            $schedule->etd_code_connecting,
            $schedule->eta_nha,
            $schedule->connecting2_vessel,
            $schedule->connecting2_voyage,
            $schedule->connecting2_etd,
            $schedule->eta_klf,
            $schedule->connecting_klf,
            $schedule->connecting_eta,
            $schedule->remarks_field,
        ];
    }

    public function headings(): array
    {
        return [
            'type',
            'service',
            'pol',
            'pod',
            'vessel',
            'voyage',
            'etd',
            'eta_destination',
            'eta_code_connecting',
            'eta_destination1',
            'eta_destination2',
            'eta_destination3',
            'eta_destination4',
            'eta_destination5',
            'eta_destination6',
            'eta_destination7',
            'eta_text',
            'connecting_vessel',
            'connecting_voyage',
            'connecting_etd',
            'etd_code_connecting',
            'eta_nha',
            'connecting2_vessel',
            'connecting2_voyage',
            'connecting2_etd',
            'eta_klf',
            'connecting_klf',
            'connecting_eta',
            'remarks_field'
        ];
    }

    public function title(): string
    {
        return 'Sailing Schedules';
    }

    public function columnWidths(): array
    {
        return [
            'A'  => 12, // type
            'B'  => 12, // service
            'C'  => 20, // pol
            'D'  => 20, // pod
            'E'  => 25, // vessel
            'F'  => 15, // voyage
            'G'  => 15, // etd
            'H'  => 18, // eta_destination
            'I'  => 22, // eta_code_connecting
            'J'  => 18, // eta_destination1
            'K'  => 18, // eta_destination2
            'L'  => 18, // eta_destination3
            'M'  => 18, // eta_destination4
            'N'  => 18, // eta_destination5
            'O'  => 18, // eta_destination6
            'P'  => 18, // eta_destination7
            'Q'  => 20, // eta_text
            'R'  => 25, // connecting_vessel
            'S'  => 20, // connecting_voyage
            'T'  => 18, // connecting_etd
            'U'  => 22, // etd_code_connecting
            'V'  => 18, // eta_nha
            'W'  => 25, // connecting2_vessel
            'X'  => 20, // connecting2_voyage
            'Y'  => 18, // connecting2_etd
            'Z'  => 18, // eta_klf
            'AA' => 18, // connecting_klf
            'AB' => 18, // connecting_eta
            'AC' => 25, // remarks_field
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = max(2, count($this->schedules) + 1);

        // Header Styling
        $sheet->getStyle('A1:AC1')->applyFromArray([
            'font' => [
                'bold'  => true,
                'color' => ['argb' => 'FFFFFFFF'],
                'size'  => 11,
            ],
            'fill' => [
                'fillType'   => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF2391FF'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color'       => ['argb' => 'FF000000'],
                ],
            ],
        ]);

        $sheet->getRowDimension(1)->setRowHeight(25);

        // Data Rows Styling
        if ($lastRow >= 2) {
            $sheet->getStyle("A2:AC{$lastRow}")->applyFromArray([
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color'       => ['argb' => 'FFE0E0E0'],
                    ],
                ],
            ]);
        }

        $sheet->freezePane('A2');

        return [];
    }
}
