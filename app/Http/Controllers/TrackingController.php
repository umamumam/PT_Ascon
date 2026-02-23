<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use Illuminate\Http\Request;
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
            'bl_number'         => ['required', 'string', 'unique:trackings'],
            'shipper'           => ['required', 'string'],
            'consignee'         => ['required', 'string'],
            'origin'            => ['required', 'string'],
            'destination'       => ['required', 'string'],
            'type'              => ['required', 'in:Export,Import'],
            'shipment_type'     => ['required', 'in:LCL,FCL'],
            'total_measurement' => ['nullable', 'string'],
            'total_packages'    => ['nullable', 'string'],
            'container_number'  => ['nullable', 'string'],
            'size_type'         => ['nullable', 'string'],
            'vessel_voyage'     => ['required', 'string'],
            'etd'               => ['required', 'date'],
            'eta'               => ['required', 'date'],
            'connecting_vessel1' => ['nullable', 'string'],
            'connecting_etd1'    => ['nullable', 'date'],
            'connecting_eta1'    => ['nullable', 'date'],
            'connecting_vessel2' => ['nullable', 'string'],
            'connecting_etd2'    => ['nullable', 'date'],
            'connecting_eta2'    => ['nullable', 'date'],
            'connecting_vessel3' => ['nullable', 'string'],
            'connecting_etd3'    => ['nullable', 'date'],
            'connecting_eta3'    => ['nullable', 'date'],
            'remarks'           => ['nullable', 'string'],
        ]);

        Tracking::create($request->all());

        return redirect()->route('trackings.index')->with('success', 'Data tracking berhasil ditambahkan.');
    }

    public function update(Request $request, Tracking $tracking)
    {
        $request->validate([
            'bl_number'         => ['required', 'string', 'unique:trackings,bl_number,' . $tracking->id],
            'shipper'           => ['required', 'string'],
            'consignee'         => ['required', 'string'],
            'origin'            => ['required', 'string'],
            'destination'       => ['required', 'string'],
            'type'              => ['required', 'in:Export,Import'],
            'shipment_type'     => ['required', 'in:LCL,FCL'],
            'total_measurement' => ['nullable', 'string'],
            'total_packages'    => ['nullable', 'string'],
            'container_number'  => ['nullable', 'string'],
            'size_type'         => ['nullable', 'string'],
            'vessel_voyage'     => ['required', 'string'],
            'etd'               => ['required', 'date'],
            'eta'               => ['required', 'date'],
            'connecting_vessel1' => ['nullable', 'string'],
            'connecting_etd1'    => ['nullable', 'date'],
            'connecting_eta1'    => ['nullable', 'date'],
            'connecting_vessel2' => ['nullable', 'string'],
            'connecting_etd2'    => ['nullable', 'date'],
            'connecting_eta2'    => ['nullable', 'date'],
            'connecting_vessel3' => ['nullable', 'string'],
            'connecting_etd3'    => ['nullable', 'date'],
            'connecting_eta3'    => ['nullable', 'date'],
            'remarks' => ['nullable', 'string'],
        ]);

        $tracking->update($request->all());

        return redirect()->route('trackings.index')->with('success', 'Data tracking berhasil diperbarui.');
    }

    public function destroy(Tracking $tracking)
    {
        $tracking->delete();
        return redirect()->route('trackings.index')->with('success', 'Data tracking berhasil dihapus.');
    }

    public function downloadTemplate(): BinaryFileResponse
    {
        return Excel::download(new TrackingTemplateExport(), 'tracking_template.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls,csv|max:5120',
            'default_type' => 'nullable|in:Export,Import',
            'default_shipment_type' => 'nullable|in:LCL,FCL',
        ]);

        try {
            $import = new TrackingImport();

            if ($request->has('default_type') && !empty($request->default_type)) {
                $import->setDefaultType($request->default_type);
            }

            if ($request->has('default_shipment_type') && !empty($request->default_shipment_type)) {
                $import->setDefaultShipmentType($request->default_shipment_type);
            }

            Excel::import($import, $request->file('excel_file'));

            $successMessage = "Data tracking berhasil diimport!";
            $successMessage .= " Total data diproses: {$import->getRowCount()}";
            $successMessage .= " - Berhasil diimport: {$import->getImportedCount()}";

            // Tampilkan rows yang gagal jika ada
            $failedRows = $import->getFailedRows();
            if (!empty($failedRows)) {
                $errorDetails = "<br><br><strong>Data yang gagal diimport:</strong><br>";
                foreach ($failedRows as $rowNumber => $error) {
                    $errorDetails .= "Baris {$rowNumber}: {$error}<br>";
                }

                // Gunakan with() tanpa html_entity_decode
                session()->flash('warning', $successMessage . $errorDetails);
                return redirect()->route('trackings.index');
            }

            session()->flash('success', $successMessage);
            return redirect()->route('trackings.index');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            $errorMessages = [];
            foreach ($failures as $failure) {
                $row = $failure->row();
                $blNumber = $failure->values()['bl_number'] ?? 'N/A';
                $error = $failure->errors()[0];

                $errorMessages[] = "Baris {$row} (BL: {$blNumber}): {$error}";
            }

            $errorMessage = 'Terjadi kesalahan validasi:<br>' . implode('<br>', $errorMessages);
            session()->flash('error', $errorMessage);
            return redirect()->route('trackings.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->route('trackings.index');
        }
    }
    public function publicTracking(Request $request)
    {
        $tracking = null;
        $blNumber = $request->input('bl_number');
        $type = $request->input('type', 'Export');
        $shipmentType = $request->input('shipment_type', 'LCL');

        if ($blNumber) {
            $tracking = Tracking::with(['details' => function($query) {
                $query->orderBy('date', 'asc')->orderBy('id', 'asc');
            }])
            ->where('bl_number', $blNumber)
            ->where('type', $type)
            ->where('shipment_type', $shipmentType)
            ->first();
        }

        // Group details by sequence
        $groupedDetails = [];
        if ($tracking && $tracking->details) {
            foreach ($tracking->details as $detail) {
                if ($detail->sequence) {
                    $groupedDetails[$detail->sequence][] = $detail;
                }
            }
        }

        return view('landing.etracking', compact('tracking', 'blNumber', 'type', 'shipmentType', 'groupedDetails'));
    }
}
