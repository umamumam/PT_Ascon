<?php

namespace App\Imports;

use App\Models\Tracking;
use App\Models\TrackingDetail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Carbon\Carbon;

class TrackingDetailSheetImport implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    private $failedRows = [];

    public function model(array $row)
    {
        $bl = isset($row['bl_number']) ? trim((string)$row['bl_number']) : '';
        $status = isset($row['status']) ? trim((string)$row['status']) : '';
        $date = $row['date'] ?? null;

        if ($bl === '' || $status === '' || empty($date) || str_contains($bl, '#')) {
            return null;
        }

        try {
            $tracking = Tracking::where('bl_number', $bl)->first();

            if (!$tracking) {
                $this->failedRows[] = "BL {$bl} tidak ditemukan di database (Sheet 1).";
                return null;
            }

            return TrackingDetail::updateOrCreate(
                [
                    'tracking_id' => $tracking->id,
                    'status'      => $status,
                    'date'        => $this->parseDate($date),
                ],
                [
                    'vessel_information' => $row['vessel_information'] ?? ($status === 'departed' ? $tracking->vessel_voyage : null),
                    'place_of_activity'  => $row['place_of_activity'],
                    'remarks'            => $row['remarks'],
                    'sequence'           => null,
                ]
            );
        } catch (\Exception $e) {
            $this->failedRows[] = "Baris BL {$bl}: " . $e->getMessage();
            return null;
        }
    }

    private function parseDate($date)
    {
        if (empty($date)) return null;
        try {
            if (is_numeric($date)) {
                return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date))->format('Y-m-d');
            }
            return Carbon::parse($date)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getFailedRows()
    {
        return $this->failedRows;
    }
}
