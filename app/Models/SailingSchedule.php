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
        'vessel',
        'voyage',
        'etd',
        'eta_destination',
        'eta_code_connecting',
        'eta_destination1',
        'eta_destination2',
        'eta_destination3',
        'eta_destination4',
        'eta_destination5',
        'eta_destination6',
        'eta_destination7',
        'eta_text',
        'connecting_vessel',
        'connecting_voyage',
        'connecting_etd',
        'etd_code_connecting',
        'connecting_eta',
        // 'code_connecting',
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
}
