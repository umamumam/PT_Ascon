<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tracking extends Model
{
    use HasFactory;

    protected $table = 'trackings';

    protected $fillable = [
        'bl_number',
        'shipper',
        'consignee',
        'origin',
        'destination',
        'type',
        'shipment_type',
        'total_measurement',
        'total_packages',
        'container_number',
        'size_type',
        'vessel_voyage',
        'etd',
        'eta',
        'connecting_vessel1',
        'connecting_etd1',
        'connecting_eta1',
        'connecting_vessel2',
        'connecting_etd2',
        'connecting_eta2',
        'connecting_vessel3',
        'connecting_etd3',
        'connecting_eta3',
        'remarks'
    ];

    protected $casts = [
        'etd' => 'date',
        'eta' => 'date',
        'connecting_etd1' => 'date',
        'connecting_eta1' => 'date',
        'connecting_etd2' => 'date',
        'connecting_eta2' => 'date',
        'connecting_etd3' => 'date',
        'connecting_eta3' => 'date',
    ];

    public function details(): HasMany
    {
        return $this->hasMany(TrackingDetail::class, 'tracking_id')->orderBy('date', 'asc');
    }
}
