<?php

namespace App\Imports;

use App\Models\Tracking;
use App\Models\TrackingDetail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class TrackingDetailSheetImport implements ToModel, WithHeadingRow
{
    private $failedRows = [];
    private $dataSheetImport;
    private $lastBl = '';

    public function __construct(TrackingDataSheetImport $dataSheetImport = null)
    {
        $this->dataSheetImport = $dataSheetImport;
    }

    public function model(array $row)
    {
        // Clean up Excel calculation errors
        foreach ($row as $key => $value) {
            if (is_string($value)) {
                $value = trim($value);
                if (str_starts_with($value, '#')) {
                    $row[$key] = null;
                } else {
                    $row[$key] = $value;
                }
            }
        }

        $bl = isset($row['bl_number']) ? trim((string)$row['bl_number']) : '';
        $dateOfDeparture = $this->parseDate($row['date_of_departure'] ?? $row['date'] ?? null);

        // Resolve BL formula if it starts with '='
        if (str_starts_with($bl, '=')) {
            if (preg_match('/Data Tracking.*!B(\d+)/i', $bl, $m) || preg_match('/B(\d+)/i', $bl, $m)) {
                $targetRow = (int)$m[1];
                $blByRow = $this->dataSheetImport ? $this->dataSheetImport->getBlByRow() : [];
                $bl = $blByRow[$targetRow] ?? '';
            } elseif (!empty($this->lastBl)) {
                $bl = $this->lastBl;
            } else {
                $bl = '';
            }
        }

        if (empty($bl)) {
            return null;
        }

        $this->lastBl = $bl;

        try {
            $tracking = Tracking::where('bl_number', $bl)->first();

            if (!$tracking) {
                return null;
            }

            $sequence = isset($row['sequence']) && !empty($row['sequence']) ? trim((string)$row['sequence']) : null;

            $placeOfActivity = isset($row['place_of_activity']) ? trim((string)$row['place_of_activity']) : '';
            if (str_starts_with($placeOfActivity, '=')) {
                $placeOfActivity = $tracking->origin;
            }

            $vesselInfo = isset($row['vessel_information']) ? trim((string)$row['vessel_information']) : '';
            if (str_starts_with($vesselInfo, '=')) {
                if ($sequence) {
                    $vesselInfo = !empty($placeOfActivity) ? 'Connecting Vessel' : '';
                } else {
                    $vesselInfo = $tracking->vessel_voyage;
                }
            } elseif (empty($vesselInfo) && !empty($sequence) && !empty($placeOfActivity)) {
                $vesselInfo = 'Connecting Vessel';
            }

            $portOfArrival = isset($row['port_of_arrival']) ? trim((string)$row['port_of_arrival']) : '';
            if (str_starts_with($portOfArrival, '=')) {
                $portOfArrival = $tracking->destination;
            }

            $dateOfArrival = $this->parseDate($row['date_of_arrival'] ?? null);
            $remarks = isset($row['remarks']) ? trim((string)$row['remarks']) : null;

            // Skip detail row if all detail fields are empty
            if (empty($vesselInfo) && empty($placeOfActivity) && empty($dateOfDeparture) && empty($portOfArrival) && empty($dateOfArrival) && empty($remarks)) {
                return null;
            }

            return TrackingDetail::updateOrCreate(
                [
                    'tracking_id' => $tracking->id,
                    'sequence'    => $sequence,
                ],
                [
                    'vessel_information' => $vesselInfo ?: null,
                    'place_of_activity'  => $placeOfActivity ?: null,
                    'date_of_departure' => $dateOfDeparture,
                    'port_of_arrival'    => $portOfArrival ?: null,
                    'date_of_arrival'    => $dateOfArrival,
                    'remarks'            => $remarks,
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
