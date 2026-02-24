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
            'status'             => 'required|in:departed,discharge,connecting,arrival',
            'place_of_activity'  => 'required|string',
            'date'               => 'required|date',
            'vessel_information' => 'nullable|string',
            'remarks'            => 'nullable|string',
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

        if (empty($data['vessel_information'])) {
            if ($data['sequence'] === '1st') {
                $data['vessel_information'] = $tracking->connecting_vessel1 ?? $tracking->vessel_voyage;
            } elseif ($data['sequence'] === '2nd') {
                $data['vessel_information'] = $tracking->connecting_vessel2 ?? $tracking->vessel_voyage;
            } elseif ($data['sequence'] === '3rd') {
                $data['vessel_information'] = $tracking->connecting_vessel3 ?? $tracking->vessel_voyage;
            } else {
                $data['vessel_information'] = $tracking->vessel_voyage;
            }
        }

        $tracking->details()->create($data);

        // return redirect()->back()->with('success', 'Status tracking berhasil diperbarui!');
        $url = session('last_tracking_index_url', route('trackings.index'));
        return redirect()->to($url)->with('success', 'Status tracking berhasil diperbarui!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status'             => 'required|in:departed,discharge,connecting,arrival',
            'place_of_activity'  => 'required|string',
            'date'               => 'required|date',
            'vessel_information' => 'nullable|string',
            'remarks'            => 'nullable|string',
            'sequence'           => 'nullable|in:1st,2nd,3rd',
        ]);

        $detail = TrackingDetail::findOrFail($id);

        $detail->update($request->only([
            'status',
            'place_of_activity',
            'date',
            'vessel_information',
            'remarks',
            'sequence',
        ]));

        // return redirect()->back()->with('success', 'Riwayat berhasil diperbarui!');
        $url = session('last_tracking_index_url', route('trackings.index'));
        return redirect()->to($url)->with('success', 'Riwayat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $detail = TrackingDetail::findOrFail($id);
        $detail->delete();

        // return redirect()->back()->with('success', 'Riwayat berhasil dihapus!');
        $url = session('last_tracking_index_url', route('trackings.index'));
        return redirect()->to($url)->with('success', 'Riwayat berhasil dihapus!');
    }
}
