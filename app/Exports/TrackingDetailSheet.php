<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class TrackingDetailSheet implements FromArray, WithHeadings, WithTitle, WithStyles
{
    public function array(): array
    {
        return [
            // BL: JEA-2035217590 (Export - FCL)
            ['JEA-2035217590', 'MV. EVERGREEN 123E',  'departed',    'Jakarta',          '2026-02-24', null, null],
            ['JEA-2035217590', null,                   'discharge',   'Tanjung Pelepas',  '2026-02-28', null, null],
            ['JEA-2035217590', 'LISBON EXPRESS V.0416W', 'connecting1', 'Tanjung Pelepas', '2026-03-04', null, null],
            ['JEA-2035217590', null,                   'discharge1',  'Jebel Ali',        '2026-03-08', null, null],
            ['JEA-2035217590', 'HUI FA V.607W',       'connecting2', 'Jebel Ali',        '2026-03-12', null, null],
            ['JEA-2035217590', null,                   'arrival',     'Suwaikh',          '2026-03-16', null, null],

            // BL: 2035217590 (Import - LCL)
            ['2035217590', 'MV. OCEAN STAR 789N',     'departed',    'Suwaikh',          '2026-02-24', null, null],
            ['2035217590', null,                       'discharge',   'Tanjung Pelepas',  '2026-02-28', null, null],
            ['2035217590', 'LISBON EXPRESS V.0416W',   'connecting1', 'Tanjung Pelepas',  '2026-03-04', null, null],
            ['2035217590', null,                       'discharge1',  'Jebel Ali',        '2026-03-08', null, null],
            ['2035217590', 'HUI FA V.607W',            'connecting2', 'Jebel Ali',        '2026-03-12', null, null],
            ['2035217590', null,                       'arrival',     'Surabaya',         '2026-03-16', null, null],
        ];
    }

    public function headings(): array
    {
        return [
            'bl_number',
            'vessel_information',
            'status',
            'place_of_activity',
            'date',
            'remarks',
            'sequence',
        ];
    }

    public function title(): string
    {
        return 'Detail Tracking';
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);
        $sheet->getStyle('A1:G1')->getFill()->applyFromArray([
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['argb' => 'FFE0E0E0'],
        ]);
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }
}
