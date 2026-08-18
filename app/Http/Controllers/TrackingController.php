<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\TrackingImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TrackingTemplateExport;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class TrackingController extends Controller
{
    public function index(Request $request)
    {
        $startOfMonth = now()->startOfMonth()->format('Y-m-d');
        $endOfMonth = now()->endOfMonth()->format('Y-m-d');

        $fromDate = $request->input('from_date', $startOfMonth);
        $toDate = $request->input('to_date', $endOfMonth);

        $query = Tracking::with('details');

        if ($request->filled('shipment_type')) {
            $query->where('shipment_type', $request->shipment_type);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($fromDate && $toDate) {
            $query->whereBetween('created_at', [$fromDate . ' 00:00:00', $toDate . ' 23:59:59']);
        }

        $trackings = $query->latest()->get();

        $totalTrackings = Tracking::count();
        $totalFCL = Tracking::where('shipment_type', 'FCL')->count();
        $totalLCL = Tracking::where('shipment_type', 'LCL')->count();

        $fclPercentage = $totalTrackings > 0 ? ($totalFCL / $totalTrackings) * 100 : 0;
        $lclPercentage = $totalTrackings > 0 ? ($totalLCL / $totalTrackings) * 100 : 0;

        session(['last_tracking_index_url' => $request->fullUrl()]);

        return view('trackings.index', compact(
            'trackings',
            'totalTrackings',
            'totalFCL',
            'totalLCL',
            'fclPercentage',
            'lclPercentage',
            'fromDate',
            'toDate'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type'              => ['required', 'in:Export,Import'],
            'bl_number'         => ['required', 'string', 'unique:trackings'],
            'shipper'           => ['required', 'string'],
            'consignee'         => ['required', 'string'],
            'origin'            => ['required', 'string'],
            'destination'       => ['required', 'string'],
            'shipment_type'     => ['required', 'in:LCL,FCL'],
            'total_measurement' => ['nullable', 'string'],
            'total_packages'    => ['nullable', 'string'],
            'container_number'  => ['nullable', 'string'],
            'size_type'         => ['nullable', 'string'],
            'vessel_voyage'     => ['required', 'string'],
        ]);

        Tracking::create($request->only([
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
            'vessel_voyage',
        ]));

        return redirect()->route('trackings.index')->with('success', 'Data tracking berhasil ditambahkan.');
    }

    public function update(Request $request, Tracking $tracking)
    {
        $request->validate([
            'type'              => ['required', 'in:Export,Import'],
            'bl_number'         => ['required', 'string', 'unique:trackings,bl_number,' . $tracking->id],
            'shipper'           => ['required', 'string'],
            'consignee'         => ['required', 'string'],
            'origin'            => ['required', 'string'],
            'destination'       => ['required', 'string'],
            'shipment_type'     => ['required', 'in:LCL,FCL'],
            'total_measurement' => ['nullable', 'string'],
            'total_packages'    => ['nullable', 'string'],
            'container_number'  => ['nullable', 'string'],
            'size_type'         => ['nullable', 'string'],
            'vessel_voyage'     => ['required', 'string'],
        ]);

        $tracking->update($request->only([
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
            'vessel_voyage',
        ]));

        return redirect()->route('trackings.index')->with('success', 'Data tracking berhasil diperbarui.');
    }

    public function destroy(Tracking $tracking)
    {
        $tracking->delete();
        return redirect()->route('trackings.index')->with('success', 'Data tracking berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date'   => 'required|date|after_or_equal:from_date',
            'type'      => 'nullable|in:Export,Import',
        ]);

        $query = Tracking::query();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $query->whereBetween('created_at', [
            $request->from_date . ' 00:00:00',
            $request->to_date . ' 23:59:59'
        ]);

        $trackings = $query->get();
        $count = $trackings->count();

        if ($count === 0) {
            return redirect()->route('trackings.index')
                ->with('error', 'Tidak ada data tracking yang sesuai dengan kriteria periode dan jenis yang dipilih.');
        }

        DB::transaction(function () use ($trackings) {
            foreach ($trackings as $tracking) {
                $tracking->details()->delete();
                $tracking->delete();
            }
        });

        return redirect()->route('trackings.index')
            ->with('success', "Berhasil menghapus {$count} data tracking.");
    }

    public function downloadTemplate(): BinaryFileResponse
    {
        return Excel::download(new TrackingTemplateExport(), 'tracking_template.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file'           => 'required|file|mimes:xlsx,xls,csv|max:5120',
            'default_type'         => 'nullable|in:Export,Import',
            'default_shipment_type'=> 'nullable|in:LCL,FCL',
        ]);

        try {
            $import = new TrackingImport();

            if ($request->filled('default_type')) {
                $import->setDefaultType($request->default_type);
            }

            if ($request->filled('default_shipment_type')) {
                $import->setDefaultShipmentType($request->default_shipment_type);
            }

            Excel::import($import, $request->file('excel_file'));

            $successMessage = "Data tracking berhasil diimport!";
            $successMessage .= " Total diproses: {$import->getRowCount()}";
            $successMessage .= " - Berhasil: {$import->getImportedCount()}";

            $failedRows = $import->getFailedRows();
            if (!empty($failedRows)) {
                $errorDetails = "<br><br><strong>Data yang gagal:</strong><br>";
                foreach ($failedRows as $rowNumber => $error) {
                    $errorDetails .= "Baris {$rowNumber}: {$error}<br>";
                }
                session()->flash('warning', $successMessage . $errorDetails);
                return redirect()->route('trackings.index');
            }

            session()->flash('success', $successMessage);
            return redirect()->route('trackings.index');

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $errorMessages = [];
            foreach ($e->failures() as $failure) {
                $errorMessages[] = "Baris {$failure->row()} (BL: " . ($failure->values()['bl_number'] ?? 'N/A') . "): {$failure->errors()[0]}";
            }
            session()->flash('error', 'Validasi gagal:<br>' . implode('<br>', $errorMessages));
            return redirect()->route('trackings.index');

        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->route('trackings.index');
        }
    }

    public function publicTracking(Request $request)
    {
        $tracking     = null;
        $blNumber     = $request->input('bl_number');
        $type         = $request->input('type', 'Export');
        $shipmentType = $request->input('shipment_type', 'LCL');

        if ($blNumber) {
            $tracking = Tracking::with(['details' => function ($query) {
                $query->orderBy('id', 'asc');
            }])
                ->where('bl_number', $blNumber)
                ->where('type', $type)
                ->where('shipment_type', $shipmentType)
                ->first();
        }

        $groupedDetails = [];
        if ($tracking && $tracking->sorted_details) {
            foreach ($tracking->sorted_details as $detail) {
                if ($detail->sequence) {
                    $groupedDetails[$detail->sequence][] = $detail;
                }
            }
        }

        $connectingVessels = [];
        if ($tracking) {
            for ($i = 1; $i <= 3; $i++) {
                $vesselField = "connecting_vessel{$i}";
                $etdField    = "connecting_etd{$i}";
                $etaField    = "connecting_eta{$i}";

                if (!empty($tracking->$vesselField)) {
                    $connectingVessels[] = [
                        'vessel' => $tracking->$vesselField,
                        'etd'    => $tracking->$etdField,
                        'eta'    => $tracking->$etaField,
                    ];
                }
            }
        }

        return view('landing.etracking', compact(
            'tracking',
            'blNumber',
            'type',
            'shipmentType',
            'groupedDetails',
            'connectingVessels'
        ));
    }
}
