<?php

namespace App\Http\Controllers\User;

use App\Models\Tracking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserTrackingController extends Controller
{
    /**
     * Halaman utama user: form pencarian tracking berdasarkan BL Number.
     */
    public function index(Request $request, $type = null)
    {
        $tracking          = null;
        $blNumber          = $request->input('bl_number');
        $type              = $type ? ucfirst(strtolower($type)) : $request->input('type', 'Export');
        $shipmentType      = $request->input('shipment_type', 'LCL');
        $groupedDetails    = [];
        $connectingVessels = [];
        $searched          = false;

        if ($blNumber) {
            $searched = true;
            $tracking = Tracking::with(['details' => function ($query) {
                $query->orderBy('id', 'asc');
            }])
                ->where('bl_number', $blNumber)
                ->where('type', $type)
                ->first();

            if ($tracking) {
                $shipmentType = $tracking->shipment_type;
            }

            if ($tracking && $tracking->sorted_details) {
                foreach ($tracking->sorted_details as $detail) {
                    if ($detail->sequence) {
                        $groupedDetails[$detail->sequence][] = $detail;
                    }
                }
            }

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
        }

        return view('user.tracking.index', compact(
            'tracking',
            'blNumber',
            'type',
            'shipmentType',
            'groupedDetails',
            'connectingVessels',
            'searched'
        ));
    }
}
