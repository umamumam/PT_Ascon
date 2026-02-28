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
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Style\Conditional;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use DateTime;

class TrackingDetailSheet implements FromArray, WithHeadings, WithTitle, WithStyles, WithEvents
{
    public function array(): array
    {
        $data = [];
        $statuses = ['departed', 'discharge', 'connecting1', 'discharge1', 'connecting2', 'arrival'];
        $transitPlaces = ['Tanjung Pelepas', 'Tanjung Pelepas', 'Jebel Ali', 'Jebel Ali'];

        for ($i = 0; $i < 50; $i++) {
            $rowNum = $i + 2;
            $currentDate = new DateTime('2026-02-24');

            foreach ($statuses as $index => $status) {
                $vessel = ($status === 'departed')
                    ? "=IF('Data Tracking'!B{$rowNum}=\"\",\"\",'Data Tracking'!L{$rowNum})"
                    : null;

                $place = null;
                if ($status === 'departed') {
                    $place = "=IF('Data Tracking'!B{$rowNum}=\"\",\"\",'Data Tracking'!E{$rowNum})";
                } elseif ($status === 'arrival') {
                    $place = "=IF('Data Tracking'!B{$rowNum}=\"\",\"\",'Data Tracking'!F{$rowNum})";
                } else {
                    $place = $transitPlaces[$index - 1] ?? null;
                }

                $formattedDate = $currentDate->format('Y-m-d');
                $currentDate->modify('+4 days');

                $data[] = [
                    "=IF('Data Tracking'!B{$rowNum}=\"\",\"\",'Data Tracking'!B{$rowNum})",
                    $vessel,
                    $status,
                    $place,
                    $formattedDate,
                    null,
                    null
                ];
            }
        }
        return $data;
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
                $totalRows = (50 * 6) + 1;

                $validation = $sheet->getDataValidation("C2:C{$totalRows}");
                $validation->setType(DataValidation::TYPE_LIST)
                    ->setErrorStyle(DataValidation::STYLE_INFORMATION)
                    ->setAllowBlank(true)
                    ->setShowDropDown(true)
                    ->setFormula1('"departed,discharge,connecting1,discharge1,connecting2,arrival"');

                $sheet->getStyle("E2:E{$totalRows}")
                    ->getNumberFormat()
                    ->setFormatCode(NumberFormat::FORMAT_DATE_YYYYMMDD2);

                $conditional = new Conditional();
                $conditional->setConditionType(Conditional::CONDITION_EXPRESSION)
                    ->addCondition('$A2=""');
                $conditional->getStyle()->getFont()->setColor(new Color(Color::COLOR_WHITE));

                $sheet->getStyle("A2:G{$totalRows}")->setConditionalStyles([$conditional]);
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);
        $sheet->getStyle('A1:G1')->getFill()->applyFromArray([
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['argb' => 'FFE0E0E0']
        ]);

        $sheet->getStyle("A1:G301")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        for ($i = 2; $i <= 301; $i += 12) {
            $end = $i + 5;
            $sheet->getStyle("A{$i}:G{$end}")->getFill()->applyFromArray([
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFF9F9F9']
            ]);
        }

        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }
}
