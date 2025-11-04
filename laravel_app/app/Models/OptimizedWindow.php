<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptimizedWindow extends Model
{
    use HasFactory;

    protected $table = 'optimized_windows';

    protected $fillable = [
        'sat_id',
        'start_time',
        'end_time',
        'priority_score',
    ];

    public $timestamps = false;

    public function satellite()
    {
        return $this->belongsTo(Satellite::class, 'sat_id');
    }
}

