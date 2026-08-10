<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class SailingScheduleTemplateExport implements FromArray, WithHeadings, WithTitle, ShouldAutoSize, WithStyles
{
    protected $templateType;

    public function __construct($templateType = 'direct')
    {
        $this->templateType = $templateType;
    }

    public function array(): array
    {
        return match ($this->templateType) {
            'connecting' => [
                [
                    'Export',
                    'LCL',
                    'Jakarta',
                    'SINGAPORE',
                    'INCRES',
                    '078N',
                    '2026-08-03',
                    '2026-08-05',
                    'SIN',
                    '',
                    'WAN HAI 507',
                    'W245',
                    '2026-08-16',
                    'SIN',
                    '2026-09-13',
                    ''
                ]
            ],
            'japan' => [
                [
                    'Export',
                    'LCL',
                    'Jakarta',
                    'JAPAN',
                    'VANCOUVER',
                    '057N',
                    '2026-08-06',
                    '2026-08-17',
                    '2026-08-21',
                    '2026-08-18',
                    '2026-08-20',
                    '2026-08-18',
                    '',
                    '',
                    '',
                    ''
                ]
            ],
            'jebel_ali' => [
                [
                    'Export',
                    'LCL',
                    'Jakarta',
                    'JEBEL ALI',
                    'SPIL NISAKA',
                    '633N',
                    '2026-08-11',
                    '2026-08-14',
                    'SIN',
                    'WAN HAI 507',
                    'W245',
                    '2026-08-16',
                    'SIN',
                    '2026-08-26',
                    'TSS AMBER',
                    '2635W',
                    '2026-09-01',
                    '2026-09-09',
                    'By Truck',
                    '2026-09-13',
                    ''
                ]
            ],
            default => [
                [
                    'Export',
                    'LCL',
                    'Jakarta',
                    'SINGAPORE',
                    'INCRES',
                    '078N',
                    '2026-08-03',
                    '2026-08-05',
                    ''
                ]
            ]
        };
    }

    public function headings(): array
    {
        return match ($this->templateType) {
            'connecting' => [
                'type',
                'service',
                'pol',
                'pod',
                'vessel',
                'voyage',
                'etd',
                'eta_destination',
                'eta_code_connecting',
                'eta_text',
                'connecting_vessel',
                'connecting_voyage',
                'connecting_etd',
                'etd_code_connecting',
                'connecting_eta',
                'remarks'
            ],
            'japan' => [
                'type',
                'service',
                'pol',
                'pod',
                'vessel',
                'voyage',
                'etd',
                'eta_destination',
                'eta_destination1',
                'eta_destination2',
                'eta_destination3',
                'eta_destination4',
                'eta_destination5',
                'eta_destination6',
                'eta_destination7',
                'remarks'
            ],
            'jebel_ali' => [
                'type',
                'service',
                'pol',
                'pod',
                'vessel',
                'voyage',
                'etd',
                'eta_destination',
                'eta_code_connecting',
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
                'remarks'
            ],
            default => [
                'type',
                'service',
                'pol',
                'pod',
                'vessel',
                'voyage',
                'etd',
                'eta_destination',
                'remarks'
            ]
        };
    }

    public function title(): string
    {
        return match ($this->templateType) {
            'connecting' => 'Template With Connecting',
            'japan'      => 'Template Japan Route',
            'jebel_ali'  => 'Template Jebel Ali Route',
            default      => 'Template Direct Route'
        };
    }

    public function styles(Worksheet $sheet)
    {
        $lastCol = $sheet->getHighestColumn();

        $sheet->getStyle("A1:{$lastCol}1")->applyFromArray([
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

        $sheet->getStyle("A2:{$lastCol}2")->applyFromArray([
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
