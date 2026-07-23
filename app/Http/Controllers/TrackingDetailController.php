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
            'vessel_information' => 'nullable|string',
            'place_of_activity'  => 'nullable|string',
            'date_of_departure' => 'nullable|date',
            'port_of_arrival'    => 'nullable|string',
            'date_of_arrival'    => 'nullable|date',
            'remarks'            => 'nullable|string',
            'sequence'           => 'nullable|in:1st,2nd,3rd',
        ]);

        $tracking = Tracking::findOrFail($trackingId);

        $data = $request->only([
            'vessel_information',
            'place_of_activity',
            'date_of_departure',
            'port_of_arrival',
            'date_of_arrival',
            'remarks',
            'sequence',
        ]);

        $data['tracking_id'] = $trackingId;

        // If date field is passed instead of date_of_departure for backward compatibility
        if ($request->filled('date') && !$request->filled('date_of_departure')) {
            $data['date_of_departure'] = $request->date;
        }

        $tracking->details()->create($data);

        $url = session('last_tracking_index_url', route('trackings.index'));
        return redirect()->to($url)->with('success', 'Detail shipment berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'vessel_information' => 'nullable|string',
            'place_of_activity'  => 'nullable|string',
            'date_of_departure' => 'nullable|date',
            'port_of_arrival'    => 'nullable|string',
            'date_of_arrival'    => 'nullable|date',
            'remarks'            => 'nullable|string',
            'sequence'           => 'nullable|in:1st,2nd,3rd',
        ]);

        $detail = TrackingDetail::findOrFail($id);

        $data = $request->only([
            'vessel_information',
            'place_of_activity',
            'date_of_departure',
            'port_of_arrival',
            'date_of_arrival',
            'remarks',
            'sequence',
        ]);

        if ($request->filled('date') && !$request->filled('date_of_departure')) {
            $data['date_of_departure'] = $request->date;
        }

        $detail->update($data);

        $url = session('last_tracking_index_url', route('trackings.index'));
        return redirect()->to($url)->with('success', 'Detail shipment berhasil diperbarui!');
    }

    public function destroy($id)
    {
        TrackingDetail::findOrFail($id)->delete();

        $url = session('last_tracking_index_url', route('trackings.index'));
        return redirect()->to($url)->with('success', 'Detail shipment berhasil dihapus!');
    }
}
