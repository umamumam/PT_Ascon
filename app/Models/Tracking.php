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
    ];

    public function details(): HasMany
    {
        return $this->hasMany(TrackingDetail::class, 'tracking_id')->orderBy('date', 'asc');
    }
}
