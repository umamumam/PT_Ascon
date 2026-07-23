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
        return $this->hasMany(TrackingDetail::class, 'tracking_id')->orderBy('id', 'asc');
    }

    public function getSortedDetailsAttribute()
    {
        $seqWeights = [
            'main' => 1,
            ''     => 1,
            '1st'  => 2,
            '2nd'  => 3,
            '3rd'  => 4,
        ];

        return $this->details->sortBy(function ($item) use ($seqWeights) {
            $w = $seqWeights[strtolower($item->sequence ?? '')] ?? 1;
            return sprintf('%02d_%010d', $w, $item->id);
        })->values();
    }

    public function getEtdAttribute()
    {
        $firstDetail = $this->details->first();
        return $firstDetail ? $firstDetail->date_of_departure : null;
    }

    public function getEtaAttribute()
    {
        $lastDetail = $this->details->last();
        return $lastDetail ? ($lastDetail->date_of_arrival ?? $lastDetail->date_of_departure) : null;
    }
}

