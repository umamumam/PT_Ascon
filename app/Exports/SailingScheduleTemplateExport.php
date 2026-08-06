<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class SailingScheduleTemplateExport implements FromArray, WithHeadings, WithTitle, ShouldAutoSize, WithColumnWidths, WithStyles
{
    public function array(): array
    {
        return [
            // Sample Row 1: Direct / Single Transit
            [
                'Export',           // type
                'LCL',              // service
                'Jakarta',          // pol
                'Singapore',        // pod
                'INCRES',           // vessel
                '065N',             // voyage
                '2026-08-01',       // etd
                '2026-08-03',       // eta_destination
                'SIN',              // eta_code_connecting
                '',                 // eta_destination1
                '',                 // eta_destination2
                '',                 // eta_destination3
                '',                 // eta_destination4
                '',                 // eta_destination5
                '',                 // eta_destination6
                '',                 // eta_destination7
                '',                 // eta_text
                '',                 // connecting_vessel
                '',                 // connecting_voyage
                '',                 // connecting_etd
                '',                 // etd_code_connecting
                '',                 // eta_nha
                '',                 // connecting2_vessel
                '',                 // connecting2_voyage
                '',                 // connecting2_etd
                '',                 // eta_klf
                '',                 // connecting_klf
                '',                 // connecting_eta
                'Direct Service'    // remarks
            ],
            // Sample Row 2: Multi-stage Connecting Transit
            [
                'Export',           // type
                'FCL',              // service
                'Jakarta',          // pol
                'Jebel Ali',        // pod
                'SPIL NISAKA',      // vessel
                '633N',             // voyage
                '2026-08-11',       // etd
                '2026-08-14',       // eta_destination
                'SIN',              // eta_code_connecting
                '',                 // eta_destination1
                '',                 // eta_destination2
                '',                 // eta_destination3
                '',                 // eta_destination4
                '',                 // eta_destination5
                '',                 // eta_destination6
                '',                 // eta_destination7
                '',                 // eta_text
                'WAN HAI 507',      // connecting_vessel
                'W245',             // connecting_voyage
                '2026-08-16',       // connecting_etd
                'SIN',              // etd_code_connecting
                '2026-08-26',       // eta_nha
                'TSS AMBER',        // connecting2_vessel
                '2635W',            // connecting2_voyage
                '2026-09-01',       // connecting2_etd
                '2026-09-09',       // eta_klf
                'By Truck',         // connecting_klf
                '2026-09-13',       // connecting_eta
                'Multi-Stage Transit' // remarks
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
        return 'Sailing Schedule Template';
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
            'AC' => 25, // remarks
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Style Header (A1:AC1)
        $sheet->getStyle('A1:AC1')->applyFromArray([
            'font' => [
                'bold'  => true,
                'color' => ['argb' => 'FFFFFFFF'],
                'size'  => 11,
            ],
            'fill' => [
                'fillType'   => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF2391FF'], // Ascon Blue
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

        // Style Baris Contoh (A2:AC3)
        $sheet->getStyle('A2:AC3')->applyFromArray([
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color'       => ['argb' => 'FFCCCCCC'],
                ],
            ],
        ]);

        // Dropdown Data Validation untuk Type (Kolom A) dan Service (Kolom B)
        for ($row = 2; $row <= 100; $row++) {
            $typeValidation = $sheet->getCell("A{$row}")->getDataValidation();
            $typeValidation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
            $typeValidation->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION);
            $typeValidation->setAllowBlank(true);
            $typeValidation->setShowDropDown(true);
            $typeValidation->setFormula1('"Export,Import"');

            $serviceValidation = $sheet->getCell("B{$row}")->getDataValidation();
            $serviceValidation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
            $serviceValidation->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION);
            $serviceValidation->setAllowBlank(true);
            $serviceValidation->setShowDropDown(true);
            $serviceValidation->setFormula1('"LCL,FCL"');
        }

        $sheet->freezePane('A2');

        return [];
    }
}
