<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SailingScheduleTemplateExport implements FromArray, WithHeadings, WithTitle, ShouldAutoSize, WithColumnWidths, WithStyles
{
    public function array(): array
    {
        // Hanya 1 baris contoh saja
        return [
            [
                'Export',           // type
                'FCL',              // service
                'Jakarta',          // pol
                'Singapore',        // pod
                'HAPPY LUCKY',      // vessel
                '001N',             // voyage
                '2026-01-15',       // etd
                '2026-01-20',       // eta_destination
                'TPP',              // eta_code_connecting
                '2026-01-18',       // eta_destination1
                '2026-01-19',       // eta_destination2
                '',                 // eta_destination3
                '',                 // eta_destination4
                '',                 // eta_destination5
                '',                 // eta_destination6
                '',                 // eta_destination7
                '+/- BY BARGE 2DAYS',      // eta_text
                'LUCKY STAR',       // connecting_vessel
                '002S',             // connecting_voyage
                '2026-01-22',       // connecting_etd
                'TPP',              // etd_code_connecting
                '2026-01-25',       // connecting_eta
                'Good condition'    // remarks
            ]
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
            'connecting_eta',
            // 'code_connecting',
            'remarks'
        ];
    }

    public function title(): string
    {
        return 'Sailing Schedule Template';
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,  // type
            'B' => 10,  // service
            'C' => 20,  // pol
            'D' => 20,  // pod
            'E' => 25,  // vessel
            'F' => 15,  // voyage
            'G' => 15,  // etd
            'H' => 15,  // eta_destination
            'I' => 15,  // eta_code_connecting
            'J' => 15,  // eta_destination1
            'K' => 15,  // eta_destination2
            'L' => 15,  // eta_destination3
            'M' => 15,  // eta_destination4
            'N' => 15,  // eta_destination5
            'O' => 15,  // eta_destination6
            'P' => 15,  // eta_destination7
            'Q' => 20,  // eta_text
            'R' => 25,  // connecting_vessel
            'S' => 20,  // connecting_voyage
            'T' => 15,  // connecting_etd
            'U' => 15,  // etd_code_connecting
            'V' => 15,  // connecting_eta
            // 'W' => 25,  // code_connecting
            'W' => 25,  // remarks
        ];
    }

    public function styles(Worksheet $sheet)
    {

        $sheet->getStyle('A1:W1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FFE0E0E0',
                ],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        $sheet->getStyle('A2:W2')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        $objValidation = $sheet->getCell('A2')->getDataValidation();
        $objValidation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
        $objValidation->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION);
        $objValidation->setAllowBlank(true); // Boleh kosong
        $objValidation->setShowInputMessage(true);
        $objValidation->setShowErrorMessage(true);
        $objValidation->setShowDropDown(true);
        $objValidation->setErrorTitle('Input error');
        $objValidation->setError('Value is not in list.');
        $objValidation->setPromptTitle('Pick from list');
        $objValidation->setPrompt('Please pick a value from the drop-down list.');
        $objValidation->setFormula1('"Export,Import"');

        $serviceValidation = $sheet->getCell('B2')->getDataValidation();
        $serviceValidation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
        $serviceValidation->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION);
        $serviceValidation->setAllowBlank(true);
        $serviceValidation->setShowDropDown(true);
        $serviceValidation->setFormula1('"LCL,FCL"');

        $sheet->freezePane('A2');

        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
