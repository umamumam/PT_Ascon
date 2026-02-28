<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Conditional;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class TrackingDetailSheet implements FromArray, WithHeadings, WithTitle, WithStyles, WithEvents
{
    private array $rows;

    public function __construct()
    {
        $this->rows = [
            // BL: JEA-2035217590 (Export - FCL)
            ['JEA-2035217590', 'MV. EVERGREEN 123E',       'departed',    'Jakarta',          '2026-02-24', null, null],
            ['JEA-2035217590', null,                        'discharge',   'Tanjung Pelepas',  '2026-02-28', null, null],
            ['JEA-2035217590', 'LISBON EXPRESS V.0416W',    'connecting1', 'Tanjung Pelepas',  '2026-03-04', null, null],
            ['JEA-2035217590', null,                        'discharge1',  'Jebel Ali',        '2026-03-08', null, null],
            ['JEA-2035217590', 'HUI FA V.607W',             'connecting2', 'Jebel Ali',        '2026-03-12', null, null],
            ['JEA-2035217590', null,                        'arrival',     'Suwaikh',          '2026-03-16', null, null],

            // BL: 2035217590 (Import - LCL)
            ['2035217590', 'MV. OCEAN STAR 789N',           'departed',    'Suwaikh',          '2026-02-24', null, null],
            ['2035217590', null,                             'discharge',   'Tanjung Pelepas',  '2026-02-28', null, null],
            ['2035217590', 'LISBON EXPRESS V.0416W',         'connecting1', 'Tanjung Pelepas',  '2026-03-04', null, null],
            ['2035217590', null,                             'discharge1',  'Jebel Ali',        '2026-03-08', null, null],
            ['2035217590', 'HUI FA V.607W',                  'connecting2', 'Jebel Ali',        '2026-03-12', null, null],
            ['2035217590', null,                             'arrival',     'Surabaya',         '2026-03-16', null, null],
        ];
    }

    public function array(): array
    {
        return $this->rows;
    }

    public function headings(): array
    {
        return ['bl_number', 'vessel_information', 'status', 'place_of_activity', 'date', 'remarks', 'sequence'];
    }

    public function title(): string
    {
        return 'Detail Tracking';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $totalRows = count($this->rows) + 1; // +1 for heading row
                $lastDataRow = $totalRows;

                $validation = $sheet->getDataValidation("C2:C{$lastDataRow}");
                $validation->setType(DataValidation::TYPE_LIST)
                    ->setErrorStyle(DataValidation::STYLE_INFORMATION)
                    ->setAllowBlank(true)
                    ->setShowDropDown(true)
                    ->setFormula1('"departed,discharge,connecting1,discharge1,connecting2,arrival"');

                $sheet->getStyle("E2:E{$lastDataRow}")
                    ->getNumberFormat()
                    ->setFormatCode(NumberFormat::FORMAT_DATE_YYYYMMDD2);

                $conditional = new Conditional();
                $conditional->setConditionType(Conditional::CONDITION_EXPRESSION)
                    ->addCondition('$A2=""');
                $conditional->getStyle()->getFont()->setColor(new Color(Color::COLOR_WHITE));

                $sheet->getStyle("A2:G{$lastDataRow}")->setConditionalStyles([$conditional]);

                $sheet->getStyle("A1:G{$lastDataRow}")
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);

                $dataRowCount = count($this->rows);
                for ($i = 0; $i < $dataRowCount; $i += 12) {
                    $startRow = $i + 2;          // offset heading
                    $endRow   = min($startRow + 5, $lastDataRow);
                    $sheet->getStyle("A{$startRow}:G{$endRow}")->getFill()->applyFromArray([
                        'fillType'   => Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'FFF9F9F9'],
                    ]);
                }
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);
        $sheet->getStyle('A1:G1')->getFill()->applyFromArray([
            'fillType'   => Fill::FILL_SOLID,
            'startColor' => ['argb' => 'FFE0E0E0'],
        ]);
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }
}
