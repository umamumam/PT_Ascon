<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrackingDetail extends Model
{
    use HasFactory;

    protected $table = 'tracking_details';

    protected $fillable = [
        'tracking_id',
        'vessel_information',
        'status',
        'place_of_activity',
        'date',
        'remarks',
        'sequence',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function tracking(): BelongsTo
    {
        return $this->belongsTo(Tracking::class, 'tracking_id');
    }
}
