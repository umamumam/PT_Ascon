<?php

namespace App\Http\Controllers;

use App\Models\Port;
use App\Models\SailingSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SailingScheduleImport;
use App\Exports\SailingScheduleTemplateExport;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class SailingScheduleController extends Controller
{
    public function index(Request $request)
    {
        $startOfMonth = now()->startOfMonth()->format('Y-m-d');
        $endOfMonth = now()->endOfMonth()->format('Y-m-d');

        $fromDate = $request->input('from_date', $startOfMonth);
        $toDate = $request->input('to_date', $endOfMonth);

        $query = SailingSchedule::with(['pol', 'pod']);

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('service')) {
            $query->where('service', $request->service);
        }

        if ($request->filled('pol_id')) {
            $query->where('pol_id', $request->pol_id);
        }

        if ($request->filled('pod_id')) {
            $query->where('pod_id', $request->pod_id);
        }

        if ($fromDate && $toDate) {
            $query->whereBetween('etd', [$fromDate, $toDate]);
        }

        $schedules = $query->latest()->get();

        $totalSchedules = SailingSchedule::count();
        $totalExport = SailingSchedule::where('type', 'Export')->count();
        $totalImport = SailingSchedule::where('type', 'Import')->count();
        $totalLCL = SailingSchedule::where('service', 'LCL')->count();
        $totalFCL = SailingSchedule::where('service', 'FCL')->count();

        $exportPercentage = $totalSchedules > 0 ? number_format(($totalExport / $totalSchedules) * 100, 1) : 0;
        $importPercentage = $totalSchedules > 0 ? number_format(($totalImport / $totalSchedules) * 100, 1) : 0;
        $lclPercentage = $totalSchedules > 0 ? ($totalLCL / $totalSchedules) * 100 : 0;
        $fclPercentage = $totalSchedules > 0 ? ($totalFCL / $totalSchedules) * 100 : 0;

        $ports = Port::orderBy('port_name', 'asc')->get();

        return view('schedules.index', compact(
            'schedules',
            'ports',
            'totalExport',
            'totalImport',
            'totalLCL',
            'totalFCL',
            'totalSchedules',
            'exportPercentage',
            'importPercentage',
            'lclPercentage',
            'fclPercentage',
            'fromDate',
            'toDate'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type'              => 'required|in:Export,Import',
            'service'           => 'required|in:LCL,FCL',
            'pol_id'            => 'required|exists:ports,id',
            'pod_id'            => 'required|exists:ports,id',
            'vessel'            => 'required|string|max:100',
            'voyage'            => 'required|string|max:50',
            'etd'               => 'required|date',
            'eta_destination'   => 'required|date',
            'eta_code_connecting' => 'nullable|string|max:20',
            'eta_destination1'  => 'nullable|date',
            'eta_destination2'  => 'nullable|date',
            'eta_destination3'  => 'nullable|date',
            'eta_destination4'  => 'nullable|date',
            'eta_destination5'  => 'nullable|date',
            'eta_destination6'  => 'nullable|date',
            'eta_destination7'  => 'nullable|date',
            'eta_text'          => 'nullable|string',
            'connecting_vessel' => 'nullable|string|max:100',
            'connecting_voyage' => 'nullable|string|max:50',
            'connecting_etd'    => 'nullable|date',
            'etd_code_connecting' => 'nullable|string|max:20',
            'connecting_eta'    => 'nullable|date',
            // 'code_connecting'   => 'nullable|string|max:20',
            'remarks_field'     => 'nullable|string',
        ]);

        SailingSchedule::create($validated);

        return redirect()->route('schedules.index')->with('success', 'Jadwal baru berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $schedule = SailingSchedule::findOrFail($id);

        $validated = $request->validate([
            'type'              => 'required|in:Export,Import',
            'service'           => 'required|in:LCL,FCL',
            'pol_id'            => 'required|exists:ports,id',
            'pod_id'            => 'required|exists:ports,id',
            'vessel'            => 'required|string|max:100',
            'voyage'            => 'required|string|max:50',
            'etd'               => 'required|date',
            'eta_destination'   => 'required|date',
            'eta_code_connecting' => 'nullable|string|max:20',
            'eta_destination1'  => 'nullable|date',
            'eta_destination2'  => 'nullable|date',
            'eta_destination3'  => 'nullable|date',
            'eta_destination4'  => 'nullable|date',
            'eta_destination5'  => 'nullable|date',
            'eta_destination6'  => 'nullable|date',
            'eta_destination7'  => 'nullable|date',
            'eta_text'          => 'nullable|string',
            'connecting_vessel' => 'nullable|string|max:100',
            'connecting_voyage' => 'nullable|string|max:50',
            'connecting_etd'    => 'nullable|date',
            'etd_code_connecting' => 'nullable|string|max:20',
            'connecting_eta'    => 'nullable|date',
            // 'code_connecting'   => 'nullable|string|max:20',
            'remarks_field'     => 'nullable|string',
        ]);

        $schedule->update($validated);

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $schedule = SailingSchedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil dihapus!');
    }

    public function downloadTemplate(): BinaryFileResponse
    {
        return Excel::download(new SailingScheduleTemplateExport(), 'sailing_schedule_template.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls,csv|max:5120', // 5MB
            'default_type' => 'nullable|in:Export,Import',
            'default_service' => 'nullable|in:LCL,FCL',
        ]);

        try {
            // Validasi sebelum import
            $import = new SailingScheduleImport();

            // Set default values jika ada
            if ($request->has('default_type') && !empty($request->default_type)) {
                $import->setDefaultType($request->default_type);
            }

            if ($request->has('default_service') && !empty($request->default_service)) {
                $import->setDefaultService($request->default_service);
            }

            Excel::import($import, $request->file('excel_file'));

            return redirect()->route('schedules.index')->with('success', 'Data berhasil diimport!');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            $errorMessages = [];
            foreach ($failures as $failure) {
                $errorMessages[] = "Baris {$failure->row()}: {$failure->errors()[0]}";
            }

            return redirect()->route('schedules.index')
                ->with('error', 'Terjadi kesalahan validasi: ' . implode(', ', $errorMessages));
        } catch (\Exception $e) {
            return redirect()->route('schedules.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function publicSchedules(Request $request)
    {
        $type    = $request->input('type', 'Export');
        $service = $request->input('service', 'LCL');
        $pol_id  = $request->input('pol_id');
        $pod_id  = $request->input('pod_id');

        $localPorts = Port::whereIn('port_name', ['Jakarta', 'Semarang', 'Surabaya'])
            ->orderBy('port_name')
            ->get();

        $internationalPorts = Port::whereNotIn('port_name', ['Jakarta', 'Semarang', 'Surabaya'])
            ->orderBy('port_name')
            ->get();

        $query = SailingSchedule::with(['pol', 'pod'])
            ->where('type', $type)
            ->where('service', $service);

        if ($type == 'Export') {
            $query->whereHas('pol', function ($q) {
                $q->whereIn('port_name', ['Jakarta', 'Semarang', 'Surabaya']);
            });
            if ($pol_id) $query->where('pol_id', $pol_id);
            if ($pod_id) $query->where('pod_id', $pod_id);
        } else {
            $query->whereHas('pod', function ($q) {
                $q->whereIn('port_name', ['Jakarta', 'Semarang', 'Surabaya']);
            });
            if ($pol_id) $query->where('pol_id', $pol_id);
            if ($pod_id) $query->where('pod_id', $pod_id);
        }

        $schedules = $query->orderBy('etd', 'asc')->get();

        $groupedSchedules = $schedules->groupBy(function ($schedule) {
            return $schedule->pol->port_name . ' - ' . $schedule->pod->port_name;
        });

        $columnsPerRoute = [];
        foreach ($groupedSchedules as $route => $routeSchedules) {
            $columns = [
                'has_eta_text'     => false,
                'has_connecting'   => false,
                'has_remarks'      => false,
                'eta_destinations' => [],
            ];

            foreach ($routeSchedules as $schedule) {
                if (!empty($schedule->eta_text))
                    $columns['has_eta_text'] = true;

                if (
                    !empty($schedule->connecting_vessel)    || !empty($schedule->connecting_voyage) ||
                    !empty($schedule->connecting_etd)       || !empty($schedule->connecting_eta)    ||
                    !empty($schedule->eta_code_connecting)  || !empty($schedule->etd_code_connecting)
                ) {
                    $columns['has_connecting'] = true;
                }

                if (!empty($schedule->remarks_field))
                    $columns['has_remarks'] = true;

                for ($i = 1; $i <= 7; $i++) {
                    $etaField = "eta_destination{$i}";
                    if (!empty($schedule->$etaField) && !in_array($i, $columns['eta_destinations'])) {
                        $columns['eta_destinations'][] = $i;
                    }
                }
            }

            sort($columns['eta_destinations']);
            $columnsPerRoute[$route] = $columns;
        }

        $routeColumnLabels = [
            'JAKARTA - JAPAN' => [
                'etd'              => 'ETD JKT',
                'eta_destination'  => 'ETA TYO',
                'eta_destination1' => 'ETA YOK (via TYO)',
                'eta_destination2' => 'ETA NGY',
                'eta_destination3' => 'ETA KBE',
                'eta_destination4' => 'ETA OSK (via KBE)',
            ],
        ];

        foreach ($groupedSchedules as $route => $routeSchedules) {
            if (isset($routeColumnLabels[$route])) continue;

            $firstSchedule = $routeSchedules->first();
            if (!$firstSchedule) continue;

            $polCode = strtoupper($firstSchedule->pol->port_code ?? 'POL');
            $podCode = strtoupper($firstSchedule->pod->port_code ?? 'POD');
            $podName = strtoupper($firstSchedule->pod->port_name ?? '');

            $hasConnecting   = $columnsPerRoute[$route]['has_connecting'];
            $etaDestinations = $columnsPerRoute[$route]['eta_destinations'];

            $labels = ['etd' => "ETD {$polCode}"];

            if ($hasConnecting) {
                $withConnecting = $routeSchedules->filter(fn($s) => !empty($s->connecting_vessel));
                $total          = $withConnecting->count();

                // Resolve transit label untuk ETA (eta_code_connecting)
                $filledEta   = $withConnecting->filter(fn($s) => !empty($s->eta_code_connecting));
                $etaLabel    = $filledEta->count() > 0
                    ? $filledEta
                    ->groupBy(fn($s) => strtoupper(trim($s->eta_code_connecting)))
                    ->map->count()
                    ->sortDesc()
                    ->keys()
                    ->first()
                    : (($podName === 'JEBEL ALI') ? 'TPP' : 'SIN');

                // Resolve transit label untuk ETD (etd_code_connecting)
                $filledEtd   = $withConnecting->filter(fn($s) => !empty($s->etd_code_connecting));
                $etdLabel    = $filledEtd->count() > 0
                    ? $filledEtd
                    ->groupBy(fn($s) => strtoupper(trim($s->etd_code_connecting)))
                    ->map->count()
                    ->sortDesc()
                    ->keys()
                    ->first()
                    : (($podName === 'JEBEL ALI') ? 'TPP' : 'SIN');

                $labels['eta_destination'] = "ETA {$etaLabel}";
                $labels['connecting_etd']  = "ETD {$etdLabel}";
                $labels['connecting_eta']  = "ETA {$podCode}";
            } else {
                $labels['eta_destination'] = "ETA {$podCode}";
            }

            foreach ($etaDestinations as $etaNum) {
                $labels["eta_destination{$etaNum}"] = "ETA {$podCode} {$etaNum}";
            }

            $routeColumnLabels[$route] = $labels;
        }

        return view('landing.sailing', compact(
            'schedules',
            'groupedSchedules',
            'columnsPerRoute',
            'routeColumnLabels',
            'type',
            'service',
            'pol_id',
            'pod_id',
            'localPorts',
            'internationalPorts'
        ));
    }

    public function downloadPdf(Request $request)
    {
        $type    = $request->input('type', 'Export');
        $service = $request->input('service', 'LCL');
        $pol_id  = $request->input('pol_id');
        $pod_id  = $request->input('pod_id');

        $polName = null;
        $podName = null;
        $polCode = null;
        $podCode = null;

        if ($pol_id) {
            $pol = Port::find($pol_id);
            if ($pol) {
                $polName = $pol->port_name;
                $polCode = $pol->port_code;
            }
        }

        if ($pod_id) {
            $pod = Port::find($pod_id);
            if ($pod) {
                $podName = $pod->port_name;
                $podCode = $pod->port_code;
            }
        }

        $query = SailingSchedule::with(['pol', 'pod'])
            ->where('type', $type)
            ->where('service', $service);

        if ($type == 'Export') {
            $query->whereHas('pol', function ($q) {
                $q->whereIn('port_name', ['Jakarta', 'Semarang', 'Surabaya']);
            });
            if ($pol_id) $query->where('pol_id', $pol_id);
            if ($pod_id) $query->where('pod_id', $pod_id);
        } else {
            $query->whereHas('pod', function ($q) {
                $q->whereIn('port_name', ['Jakarta', 'Semarang', 'Surabaya']);
            });
            if ($pol_id) $query->where('pol_id', $pol_id);
            if ($pod_id) $query->where('pod_id', $pod_id);
        }

        $schedules = $query->orderBy('etd', 'asc')->get();

        $groupedSchedules = $schedules->groupBy(function ($schedule) {
            return $schedule->pol->port_name . ' - ' . $schedule->pod->port_name;
        });

        $columnsPerRoute = [];
        foreach ($groupedSchedules as $route => $routeSchedules) {
            $columns = [
                'has_eta_text'     => false,
                'has_connecting'   => false,
                'has_remarks'      => false,
                'eta_destinations' => [],
            ];

            foreach ($routeSchedules as $schedule) {
                if (!empty($schedule->eta_text))
                    $columns['has_eta_text'] = true;

                if (
                    !empty($schedule->connecting_vessel)    || !empty($schedule->connecting_voyage) ||
                    !empty($schedule->connecting_etd)       || !empty($schedule->connecting_eta)    ||
                    !empty($schedule->eta_code_connecting)  || !empty($schedule->etd_code_connecting)
                ) {
                    $columns['has_connecting'] = true;
                }

                if (!empty($schedule->remarks_field))
                    $columns['has_remarks'] = true;

                for ($i = 1; $i <= 7; $i++) {
                    $etaField = "eta_destination{$i}";
                    if (!empty($schedule->$etaField) && !in_array($i, $columns['eta_destinations'])) {
                        $columns['eta_destinations'][] = $i;
                    }
                }
            }

            sort($columns['eta_destinations']);
            $columnsPerRoute[$route] = $columns;
        }

        $routeColumnLabels = [
            'JAKARTA - JAPAN' => [
                'etd'              => 'ETD JKT',
                'eta_destination'  => 'ETA TYO',
                'eta_destination1' => 'ETA YOK (via TYO)',
                'eta_destination2' => 'ETA NGY',
                'eta_destination3' => 'ETA KBE',
                'eta_destination4' => 'ETA OSK (via KBE)',
            ],
        ];

        foreach ($groupedSchedules as $route => $routeSchedules) {
            if (isset($routeColumnLabels[$route])) continue;

            $firstSchedule = $routeSchedules->first();
            if (!$firstSchedule) continue;

            $routePolCode = strtoupper($firstSchedule->pol->port_code ?? 'POL');
            $routePodCode = strtoupper($firstSchedule->pod->port_code ?? 'POD');
            $routePodName = strtoupper($firstSchedule->pod->port_name ?? '');

            $hasConnecting   = $columnsPerRoute[$route]['has_connecting'];
            $etaDestinations = $columnsPerRoute[$route]['eta_destinations'];

            $labels = ['etd' => "ETD {$routePolCode}"];

            if ($hasConnecting) {
                $withConnecting = $routeSchedules->filter(fn($s) => !empty($s->connecting_vessel));

                // Resolve transit label untuk ETA (eta_code_connecting)
                $filledEta = $withConnecting->filter(fn($s) => !empty($s->eta_code_connecting));
                $etaLabel  = $filledEta->count() > 0
                    ? $filledEta
                    ->groupBy(fn($s) => strtoupper(trim($s->eta_code_connecting)))
                    ->map->count()
                    ->sortDesc()
                    ->keys()
                    ->first()
                    : (($routePodName === 'JEBEL ALI') ? 'TPP' : 'SIN');

                // Resolve transit label untuk ETD (etd_code_connecting)
                $filledEtd = $withConnecting->filter(fn($s) => !empty($s->etd_code_connecting));
                $etdLabel  = $filledEtd->count() > 0
                    ? $filledEtd
                    ->groupBy(fn($s) => strtoupper(trim($s->etd_code_connecting)))
                    ->map->count()
                    ->sortDesc()
                    ->keys()
                    ->first()
                    : (($routePodName === 'JEBEL ALI') ? 'TPP' : 'SIN');

                $labels['eta_destination'] = "ETA {$etaLabel}";
                $labels['connecting_etd']  = "ETD {$etdLabel}";
                $labels['connecting_eta']  = "ETA {$routePodCode}";
            } else {
                $labels['eta_destination'] = "ETA {$routePodCode}";
            }

            foreach ($etaDestinations as $etaNum) {
                $labels["eta_destination{$etaNum}"] = "ETA {$routePodCode} {$etaNum}";
            }

            $routeColumnLabels[$route] = $labels;
        }

        $export = new \App\Exports\SailingSchedulePdfExport(
            $groupedSchedules,
            $columnsPerRoute,
            $routeColumnLabels,
            $type,
            $service,
            $polName,
            $podName,
            $polCode,
            $podCode
        );

        return $export->download();
    }

    public function searchPorts(Request $request)
    {
        $query = $request->input('query', '');
        $type = $request->input('type', 'pol');
        $mode = $request->input('mode', 'Export');

        if (empty($query)) {
            return response()->json([]);
        }

        $portsQuery = Port::where('port_name', 'LIKE', "%{$query}%")
            ->orWhere('port_code', 'LIKE', "%{$query}%");

        if ($mode == 'Export') {
            if ($type == 'pol') {
                $portsQuery->whereIn('port_name', ['Jakarta', 'Semarang', 'Surabaya']);
            } else {
                $portsQuery->whereNotIn('port_name', ['Jakarta', 'Semarang', 'Surabaya']);
            }
        } else {
            if ($type == 'pol') {
                $portsQuery->whereNotIn('port_name', ['Jakarta', 'Semarang', 'Surabaya']);
            } else {
                $portsQuery->whereIn('port_name', ['Jakarta', 'Semarang', 'Surabaya']);
            }
        }

        $ports = $portsQuery->orderBy('port_name')
            ->limit(10)
            ->get(['id', 'port_name', 'port_code']);

        return response()->json($ports);
    }
}
