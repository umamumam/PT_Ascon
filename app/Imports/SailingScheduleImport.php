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

        $pol = Port::whereRaw('LOWER(TRIM(port_name)) = ?', [$polName])->first();
        $pod = Port::whereRaw('LOWER(TRIM(port_name)) = ?', [$podName])->first();

        if (!$pol) {
            throw new \Exception("Port of Loading '{$row['pol']}' tidak terdaftar di sistem.");
        }
        if (!$pod) {
            throw new \Exception("Port of Discharge '{$row['pod']}' tidak terdaftar di sistem.");
        }

        $type = !empty(trim($row['type'] ?? '')) ? Str::title(trim($row['type'])) : $this->defaultType;
        $service = !empty(trim($row['service'] ?? '')) ? strtoupper(trim($row['service'])) : $this->defaultService;

        if (!in_array($type, ['Export', 'Import'])) { $type = $this->defaultType; }
        if (!in_array($service, ['LCL', 'FCL'])) { $service = $this->defaultService; }

        return new SailingSchedule([
            'type'             => $type,
            'service'          => $service,
            'pol_id'           => $pol->id,
            'pod_id'           => $pod->id,
            'vessel'           => trim($row['vessel'] ?? ''),
            'voyage'           => trim($row['voyage'] ?? ''),
            'etd'              => $this->parseDate($row['etd'] ?? null),
            'eta_destination'  => $this->parseDate($row['eta_destination'] ?? null),
            'eta_destination1' => $this->parseDate($row['eta_destination1'] ?? null),
            'eta_destination2' => $this->parseDate($row['eta_destination2'] ?? null),
            'eta_destination3' => $this->parseDate($row['eta_destination3'] ?? null),
            'eta_destination4' => $this->parseDate($row['eta_destination4'] ?? null),
            'eta_destination5' => $this->parseDate($row['eta_destination5'] ?? null),
            'eta_destination6' => $this->parseDate($row['eta_destination6'] ?? null),
            'eta_destination7' => $this->parseDate($row['eta_destination7'] ?? null),
            'eta_text'         => trim($row['eta_text'] ?? ''),
            'connecting_vessel' => trim($row['connecting_vessel'] ?? null),
            'connecting_voyage' => trim($row['connecting_voyage'] ?? null),
            'connecting_etd'    => $this->parseDate($row['connecting_etd'] ?? null),
            'connecting_eta'    => $this->parseDate($row['connecting_eta'] ?? null),
            'code_connecting'   => trim($row['code_connecting'] ?? null),
            'remarks_field'     => trim($row['remarks'] ?? ''),
        ]);
    }

    public function rules(): array
    {
        return [
            'pol'             => 'required',
            'pod'             => 'required',
            'vessel'          => 'required',
            'voyage'          => 'required',
            'etd'             => 'required',
            'eta_destination' => 'required',
        ];
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
}
