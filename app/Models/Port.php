<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    use HasFactory;

    protected $table = 'ports';

    protected $fillable = [
        'port_code',
        'port_name',
    ];

    public function schedulesAsPol()
    {
        return $this->hasMany(SailingSchedule::class, 'pol_id');
    }

    public function schedulesAsPod()
    {
        return $this->hasMany(SailingSchedule::class, 'pod_id');
    }
}
