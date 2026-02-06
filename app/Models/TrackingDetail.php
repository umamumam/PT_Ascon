<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrackingDetail extends Model
{
    use HasFactory;

    protected $table = 'tracking_details';

    protected $fillable = [
        'tracking_id',
        'status',
        'place_of_activity',
        'date',
        'vessel_information',
        'remarks'
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function tracking(): BelongsTo
    {
        return $this->belongsTo(Tracking::class, 'tracking_id');
    }
}
