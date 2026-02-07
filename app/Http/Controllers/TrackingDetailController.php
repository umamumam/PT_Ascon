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

        $count = TrackingDetail::where('tracking_id', $trackingId)
            ->where('status', $request->status)
            ->count();

        $data = $request->all();

        if ($count == 1) {
            $data['sequence'] = '1st';
        } elseif ($count == 2) {
            $data['sequence'] = '2nd';
        } elseif ($count == 3) {
            $data['sequence'] = '3rd';
        } elseif ($count > 3) {
            $data['sequence'] = ($count) . 'th';
        } else {
            $data['sequence'] = null;
        }

        $tracking->details()->create($data);

        return redirect()->back()->with('success', 'Status tracking berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $detail = TrackingDetail::findOrFail($id);
        $detail->delete();

        return redirect()->back()->with('success', 'Riwayat berhasil dihapus!');
    }
}
