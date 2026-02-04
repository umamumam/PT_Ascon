<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{
    use HasFactory;

    protected $fillable = [
        'vessel_name',
    ];

    public function schedules()
    {
        return $this->hasMany(SailingSchedule::class, 'vessel_id');
    }

    public function connectingSchedules()
    {
        return $this->hasMany(SailingSchedule::class, 'connecting_vessel_id');
    }
}
