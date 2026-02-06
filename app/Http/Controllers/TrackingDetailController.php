<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use App\Models\TrackingDetail;
use Illuminate\Http\Request;

class TrackingDetailController extends Controller
{
    public function store(Request $request, $trackingId)
    {
        $request->validate([
            'status' => 'required|in:departed,discharge,connecting,arrival',
            'place_of_activity' => 'required|string',
            'date' => 'required|date',
            'vessel_information' => 'nullable|string',
            'remarks' => 'nullable|string',
        ]);

        $tracking = Tracking::findOrFail($trackingId);

        $tracking->details()->create($request->all());

        return redirect()->back()->with('success', 'Status tracking berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $detail = TrackingDetail::findOrFail($id);
        $detail->delete();

        return redirect()->back()->with('success', 'Riwayat berhasil dihapus!');
    }
}
