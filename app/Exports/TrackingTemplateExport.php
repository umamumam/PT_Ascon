<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TrackingTemplateExport implements FromArray, WithHeadings, WithTitle, WithStyles
{

    public function array(): array
    {
        // Contoh data untuk template
        return [
            [
                'JEA-2035217590',
                'Export',
                'FCL',
                'PT. Supplier Indonesia',
                'PT. Buyer Singapore',
                'Jakarta',
                'Singapore',
                '',
                '',
                'OOLU0711731',
                '20GP',
                'MV. EVERGREEN 123E',
                '2024-03-15',
                '2024-03-20',
                'MV. CONNECTING 456W',
                '2024-03-21',
                '2024-03-25',
                '',
                '',
                '',
                '',
                '',
                '',
                'Shipment on time'
            ],
            [
                '2035217590',
                'Import',
                'LCL',
                'PT. Supplier Japan',
                'PT. Importer Indonesia',
                'Tokyo',
                'Surabaya',
                '10.00 m3',
                '80 cartons',
                '',
                '',
                'MV. OCEAN STAR 789N',
                '2024-03-10',
                '2024-03-18',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                'Awaiting customs clearance'
            ]
        ];
    }

    public function headings(): array
    {
        return [
            'bl_number',
            'type',
            'shipment_type',
            'shipper',
            'consignee',
            'origin',
            'destination',
            'total_measurement',
            'total_packages',
            'container_number',
            'size_type',
            'vessel_voyage',
            'etd',
            'eta',
            'connecting_vessel1',
            'connecting_etd1',
            'connecting_eta1',
            'connecting_vessel2',
            'connecting_etd2',
            'connecting_eta2',
            'connecting_vessel3',
            'connecting_etd3',
            'connecting_eta3',
            'remarks'
        ];
    }

    public function title(): string
    {
        return 'Tracking Template';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            'A1:X1' => ['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['argb' => 'FFE0E0E0']]],
        ];
    }
}
