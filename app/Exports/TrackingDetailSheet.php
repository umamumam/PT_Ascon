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
        $this->rows = [];
        $currentRow = 2;

        for ($k = 2; $k <= 50; $k++) {
            $mainRow = $currentRow;
            $row1st = $mainRow + 1;
            $row2nd = $mainRow + 2;

            // Main Leg Row
            $this->rows[] = [
                "=IF('Data Tracking'!B{$k}=\"\",\"\",'Data Tracking'!B{$k})",
                "=IF(A{$mainRow}=\"\",\"\", IFERROR(VLOOKUP(A{$mainRow}, 'Data Tracking'!B:L, 11, FALSE), \"\"))",
                "=IF(A{$mainRow}=\"\",\"\", IFERROR(VLOOKUP(A{$mainRow}, 'Data Tracking'!B:E, 4, FALSE), \"\"))",
                null,
                "=IF(A{$mainRow}=\"\",\"\", IFERROR(VLOOKUP(A{$mainRow}, 'Data Tracking'!B:F, 5, FALSE), \"\"))",
                null,
                null,
                null
            ];

            // 1st Update Row
            $this->rows[] = [
                "=IF(A{$mainRow}=\"\",\"\", A{$mainRow})",
                "=IF(C{$row1st}<>\"\",\"Connecting Vessel\",\"\")",
                null,
                null,
                null,
                null,
                null,
                '1st'
            ];

            // 2nd Update Row
            $this->rows[] = [
                "=IF(A{$mainRow}=\"\",\"\", A{$mainRow})",
                "=IF(C{$row2nd}<>\"\",\"Connecting Vessel\",\"\")",
                null,
                null,
                null,
                null,
                null,
                '2nd'
            ];

            $currentRow += 3;
        }
    }

    public function array(): array
    {
        return $this->rows;
    }

    public function headings(): array
    {
        return [
            'bl_number',
            'vessel_information',
            'place_of_activity',
            'date_of_departure',
            'port_of_arrival',
            'date_of_arrival',
            'remarks',
            'sequence'
        ];
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
                $lastDataRow = count($this->rows) + 1;

                $validation = $sheet->getDataValidation("H2:H{$lastDataRow}");
                $validation->setType(DataValidation::TYPE_LIST)
                    ->setErrorStyle(DataValidation::STYLE_INFORMATION)
                    ->setAllowBlank(true)
                    ->setShowDropDown(true)
                    ->setFormula1('"1st,2nd,3rd"');

                $sheet->getStyle("D2:D{$lastDataRow}")
                    ->getNumberFormat()
                    ->setFormatCode(NumberFormat::FORMAT_DATE_YYYYMMDD2);

                $sheet->getStyle("F2:F{$lastDataRow}")
                    ->getNumberFormat()
                    ->setFormatCode(NumberFormat::FORMAT_DATE_YYYYMMDD2);

                $conditional = new Conditional();
                $conditional->setConditionType(Conditional::CONDITION_EXPRESSION)
                    ->addCondition('$A2=""');
                $conditional->getStyle()->getFont()->setColor(new Color(Color::COLOR_WHITE));

                $sheet->getStyle("A2:H{$lastDataRow}")->setConditionalStyles([$conditional]);

                $sheet->getStyle("A1:H{$lastDataRow}")
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);
        $sheet->getStyle('A1:H1')->getFill()->applyFromArray([
            'fillType'   => Fill::FILL_SOLID,
            'startColor' => ['argb' => 'FFE0E0E0'],
        ]);
        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }
}
