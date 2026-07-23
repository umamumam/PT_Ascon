<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class TrackingDataSheet implements FromArray, WithHeadings, WithTitle, WithStyles
{
    public function array(): array
    {
        // Contoh data awal
        return [
            ['Export', 'JEA-2035217590', 'PT DALIATEX', 'RISHAB WORLD PRIVATE LTD', 'Jakarta', 'Suwaikh', 'FCL', null, null, 'OOLU0711731', '20GP', 'MV. EVERGREEN 123E'],
            ['Import', '2035217590', 'AAIRA IMPEX PRIVATE LTD', 'PT FUJITEX', 'Suwaikh', 'Surabaya', 'LCL', '10.00 m3', '80 cartons', null, null, 'MV. OCEAN STAR 789N'],
        ];
    }

    public function headings(): array
    {
        return [
            'type',
            'bl_number',
            'shipper',
            'consignee',
            'origin',
            'destination',
            'shipment_type',
            'total_measurement',
            'total_packages',
            'container_number',
            'size_type',
            'vessel_voyage'
        ];
    }

    public function title(): string
    {
        return 'Data Tracking';
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:L1')->getFont()->setBold(true);
        $sheet->getStyle('A1:L1')->getFill()->applyFromArray([
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['argb' => 'FFE0E0E0']
        ]);
        foreach (range('A', 'L') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }
}
