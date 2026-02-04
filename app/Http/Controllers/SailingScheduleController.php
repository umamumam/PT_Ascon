<?php

namespace App\Http\Controllers;

use App\Models\Port;
use App\Models\Vessel;
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
    // Query dasar
    $query = SailingSchedule::with(['pol', 'pod', 'vessel', 'connectingVessel']);

    // Filter berdasarkan type (Export/Import)
    if ($request->has('type') && !empty($request->type)) {
        $query->where('type', $request->type);
    }

    // Filter berdasarkan service (LCL/FCL)
    if ($request->has('service') && !empty($request->service)) {
        $query->where('service', $request->service);
    }

    // Filter berdasarkan POL (Port of Loading)
    if ($request->has('pol_id') && !empty($request->pol_id)) {
        $query->where('pol_id', $request->pol_id);
    }

    // Filter berdasarkan POD (Port of Destination)
    if ($request->has('pod_id') && !empty($request->pod_id)) {
        $query->where('pod_id', $request->pod_id);
    }

    // Ambil data dengan filter
    $schedules = $query->latest()->get();

    // Hitung statistik untuk semua data (tanpa filter)
    $totalExport = SailingSchedule::where('type', 'Export')->count();
    $totalImport = SailingSchedule::where('type', 'Import')->count();
    $totalLCL = SailingSchedule::where('service', 'LCL')->count();
    $totalFCL = SailingSchedule::where('service', 'FCL')->count();
    $totalSchedules = SailingSchedule::count();

    // Hitung persentase
    $exportPercentage = $totalSchedules > 0 ? number_format(($totalExport / $totalSchedules) * 100, 1) : 0;
    $importPercentage = $totalSchedules > 0 ? number_format(($totalImport / $totalSchedules) * 100, 1) : 0;
    $lclPercentage = $totalSchedules > 0 ? ($totalLCL / $totalSchedules) * 100 : 0;
    $fclPercentage = $totalSchedules > 0 ? ($totalFCL / $totalSchedules) * 100 : 0;

    $ports = Port::orderBy('port_name', 'asc')->get();
    $vessels = Vessel::orderBy('vessel_name', 'asc')->get();

    return view('schedules.index', compact(
        'schedules',
        'ports',
        'vessels',
        'totalExport',
        'totalImport',
        'totalLCL',
        'totalFCL',
        'totalSchedules',
        'exportPercentage',
        'importPercentage',
        'lclPercentage',
        'fclPercentage'
    ));
}
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type'                  => 'required|in:Export,Import',
            'service'               => 'required|in:LCL,FCL',
            'pol_id'                => 'required|exists:ports,id',
            'pod_id'                => 'required|exists:ports,id',
            'vessel_id'             => 'required|exists:vessels,id',
            'voyage'                => 'required|string|max:50',
            'etd'                   => 'required|date',
            'eta_destination'       => 'required|date',
            'eta_destination1'      => 'nullable|date',
            'eta_destination2'      => 'nullable|date',
            'eta_destination3'      => 'nullable|date',
            'eta_destination4'      => 'nullable|date',
            'eta_destination5'      => 'nullable|date',
            'eta_destination6'      => 'nullable|date',
            'eta_destination7'      => 'nullable|date',
            'eta_text'              => 'nullable|string',
            'connecting_vessel_id'  => 'nullable|exists:vessels,id',
            'connecting_voyage'     => 'nullable|string|max:50',
            'connecting_etd'        => 'nullable|date',
            'connecting_eta'        => 'nullable|date',
            'remarks_field'         => 'nullable|string',
        ]);

        SailingSchedule::create($validated);

        return redirect()->route('schedules.index')->with('success', 'Jadwal baru berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $schedule = SailingSchedule::findOrFail($id);

        $validated = $request->validate([
            'type'                  => 'required|in:Export,Import',
            'service'               => 'required|in:LCL,FCL',
            'pol_id'                => 'required|exists:ports,id',
            'pod_id'                => 'required|exists:ports,id',
            'vessel_id'             => 'required|exists:vessels,id',
            'voyage'                => 'required|string|max:50',
            'etd'                   => 'required|date',
            'eta_destination'       => 'required|date',
            'eta_destination1'      => 'nullable|date',
            'eta_destination2'      => 'nullable|date',
            'eta_destination3'      => 'nullable|date',
            'eta_destination4'      => 'nullable|date',
            'eta_destination5'      => 'nullable|date',
            'eta_destination6'      => 'nullable|date',
            'eta_destination7'      => 'nullable|date',
            'eta_text'              => 'nullable|string',
            'connecting_vessel_id'  => 'nullable|exists:vessels,id',
            'connecting_voyage'     => 'nullable|string|max:50',
            'connecting_etd'        => 'nullable|date',
            'connecting_eta'        => 'nullable|date',
            'remarks_field'         => 'nullable|string',
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
}
