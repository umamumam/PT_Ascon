<?php

namespace App\Imports;

use App\Models\SailingSchedule;
use App\Models\Port;
use App\Models\Vessel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SailingScheduleImport implements ToModel, WithHeadingRow, WithValidation
{
    private $defaultType = 'Export';
    private $defaultService = 'LCL';

    public function setDefaultType($type)
    {
        $this->defaultType = $type;
    }

    public function setDefaultService($service)
    {
        $this->defaultService = $service;
    }

    public function model(array $row)
    {
        $polName = Str::lower(trim($row['pol'] ?? ''));
        $podName = Str::lower(trim($row['pod'] ?? ''));
        $vesselName = Str::lower(trim($row['vessel'] ?? ''));

        $pol = Port::whereRaw('LOWER(TRIM(port_name)) = ?', [$polName])->first();
        $pod = Port::whereRaw('LOWER(TRIM(port_name)) = ?', [$podName])->first();
        $vessel = Vessel::whereRaw('LOWER(TRIM(vessel_name)) = ?', [$vesselName])->first();

        $connectingVessel = null;
        if (!empty($row['connecting_vessel'])) {
            $connectingVesselName = Str::lower(trim($row['connecting_vessel']));
            $connectingVessel = Vessel::whereRaw('LOWER(TRIM(vessel_name)) = ?', [$connectingVesselName])->first();
        }

        if (!$pol) {
            throw new \Exception("Port of Loading '{$row['pol']}' tidak ditemukan di database.");
        }
        if (!$pod) {
            throw new \Exception("Port of Discharge '{$row['pod']}' tidak ditemukan di database.");
        }
        if (!$vessel) {
            throw new \Exception("Vessel '{$row['vessel']}' tidak ditemukan di database.");
        }

        $type = !empty(trim($row['type'] ?? '')) ? Str::title(trim($row['type'])) : $this->defaultType;
        $service = !empty(trim($row['service'] ?? '')) ? strtoupper(trim($row['service'])) : $this->defaultService;

        if (!in_array($type, ['Export', 'Import'])) {
            $type = $this->defaultType;
        }
        if (!in_array($service, ['LCL', 'FCL'])) {
            $service = $this->defaultService;
        }

        return new SailingSchedule([
            'type'                 => $type,
            'service'              => $service,
            'pol_id'               => $pol->id,
            'pod_id'               => $pod->id,
            'vessel_id'            => $vessel->id,
            'voyage'               => trim($row['voyage'] ?? ''),
            'etd'                  => $this->parseDate($row['etd'] ?? null),
            'eta_destination'      => $this->parseDate($row['eta_destination'] ?? null),
            'eta_destination1'     => $this->parseDate($row['eta_destination1'] ?? null),
            'eta_destination2'     => $this->parseDate($row['eta_destination2'] ?? null),
            'eta_destination3'     => $this->parseDate($row['eta_destination3'] ?? null),
            'eta_destination4'     => $this->parseDate($row['eta_destination4'] ?? null),
            'eta_destination5'     => $this->parseDate($row['eta_destination5'] ?? null),
            'eta_destination6'     => $this->parseDate($row['eta_destination6'] ?? null),
            'eta_destination7'     => $this->parseDate($row['eta_destination7'] ?? null),
            'eta_text'             => trim($row['eta_text'] ?? ''),
            'connecting_vessel_id' => $connectingVessel->id ?? null,
            'connecting_voyage'    => trim($row['connecting_voyage'] ?? ''),
            'connecting_etd'       => $this->parseDate($row['connecting_etd'] ?? null),
            'connecting_eta'       => $this->parseDate($row['connecting_eta'] ?? null),
            'remarks_field'        => trim($row['remarks'] ?? ''),
        ]);
    }

    public function rules(): array
    {
        return [
            'type' => 'nullable|in:Export,Import,export,import',
            'service' => 'nullable|in:LCL,FCL,lcl,fcl',
            'pol' => 'required',
            'pod' => 'required',
            'vessel' => 'required',
            'voyage' => 'required',
            'etd' => 'required|date',
            'eta_destination' => 'required|date',
        ];
    }

    private function parseDate($date)
    {
        if (empty($date)) {
            return null;
        }

        try {
            if (is_numeric($date)) {
                return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date));
            }
            return Carbon::parse($date);
        } catch (\Exception $e) {
            return null;
        }
    }
}
