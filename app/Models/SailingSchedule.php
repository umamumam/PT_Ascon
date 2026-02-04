<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SailingSchedule extends Model
{
    use HasFactory;

    protected $table = 'sailing_schedules';

    protected $fillable = [
        'type',
        'service',
        'pol_id',
        'pod_id',
        'vessel_id',
        'voyage',
        'etd',
        'eta_destination',
        'eta_destination1',
        'eta_destination2',
        'eta_destination3',
        'eta_destination4',
        'eta_destination5',
        'eta_destination6',
        'eta_destination7',
        'eta_text',
        'connecting_vessel_id',
        'connecting_voyage',
        'connecting_etd',
        'connecting_eta',
        'remarks_field',
    ];

    public function pol()
    {
        return $this->belongsTo(Port::class, 'pol_id');
    }

    public function pod()
    {
        return $this->belongsTo(Port::class, 'pod_id');
    }

    public function vessel()
    {
        return $this->belongsTo(Vessel::class, 'vessel_id');
    }

    public function connectingVessel()
    {
        return $this->belongsTo(Vessel::class, 'connecting_vessel_id');
    }
}
