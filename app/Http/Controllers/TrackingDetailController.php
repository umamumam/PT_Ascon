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
            'status'             => 'required|in:departed,discharge,connecting1,discharge1,connecting2,arrival,depature',
            'place_of_activity'  => 'required|string',
            'date'               => 'required|date',
            'vessel_information' => 'nullable|string',
            'remarks'            => 'nullable|string',
        ]);

        $tracking = Tracking::findOrFail($trackingId);

        $data = $request->only([
            'status',
            'place_of_activity',
            'date',
            'vessel_information',
            'remarks',
        ]);

        $data['tracking_id'] = $trackingId;

        if ($request->status === 'departed' && !$request->filled('vessel_information')) {
            $data['vessel_information'] = $tracking->vessel_voyage;
        } else {
            $data['vessel_information'] = $request->filled('vessel_information')
                ? $request->vessel_information
                : null;
        }

        if ($request->status === 'depature') {
            $countDepature = TrackingDetail::where('tracking_id', $trackingId)
                ->where('status', 'depature')
                ->count();

            $data['sequence'] = match($countDepature) {
                0       => '1st',
                1       => '2nd',
                2       => '3rd',
                default => '1st',
            };
        } else {
            $data['sequence'] = $this->sequenceMap[$request->status] ?? null;
        }

        $tracking->details()->create($data);

        $url = session('last_tracking_index_url', route('trackings.index'));
        return redirect()->to($url)->with('success', 'Status tracking berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status'             => 'required|in:departed,discharge,connecting1,discharge1,connecting2,arrival,depature',
            'place_of_activity'  => 'required|string',
            'date'               => 'required|date',
            'vessel_information' => 'nullable|string',
            'remarks'            => 'nullable|string',
            'sequence'           => 'nullable|in:1st,2nd,3rd',
        ]);

        $detail = TrackingDetail::findOrFail($id);


        if ($request->filled('sequence')) {
            $sequence = $request->sequence;
        } elseif ($request->status === 'depature') {
            $countDepature = TrackingDetail::where('tracking_id', $detail->tracking_id)
                ->where('status', 'depature')
                ->where('id', '!=', $id)
                ->count();

            $sequence = match($countDepature) {
                0       => '1st',
                1       => '2nd',
                2       => '3rd',
                default => '1st',
            };
        } else {
            $sequence = $this->sequenceMap[$request->status] ?? null;
        }

        $detail->update([
            'status'             => $request->status,
            'place_of_activity'  => $request->place_of_activity,
            'date'               => $request->date,
            'vessel_information' => $request->vessel_information,
            'remarks'            => $request->remarks,
            'sequence'           => $sequence,
        ]);

        $url = session('last_tracking_index_url', route('trackings.index'));
        return redirect()->to($url)->with('success', 'Riwayat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        TrackingDetail::findOrFail($id)->delete();

        $url = session('last_tracking_index_url', route('trackings.index'));
        return redirect()->to($url)->with('success', 'Riwayat berhasil dihapus!');
    }
}
