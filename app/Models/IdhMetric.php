<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdhMetric extends Model
{
    protected $table = 'idh_metrics';
    protected $fillable = ['metric_name', 'value', 'recorded_at', 'region', 'notes'];

    protected $casts = [
        'recorded_at' => 'date',
    ];
}
