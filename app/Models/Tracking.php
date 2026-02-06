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
        'connecting_vessel',
        'connecting_etd',
        'connecting_eta',
        'remarks'
    ];

    protected $casts = [
        'etd' => 'date',
        'eta' => 'date',
        'connecting_etd' => 'date',
        'connecting_eta' => 'date',
    ];

    public function details(): HasMany
    {
        return $this->hasMany(TrackingDetail::class, 'tracking_id')->orderBy('date', 'asc');
    }
}
