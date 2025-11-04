<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pass extends Model
{
    use HasFactory;

    protected $table = 'passes';

    protected $fillable = [
        'sat_id',
        'start_time',
        'end_time',
        'elevation',
        'duration',
    ];

    public $timestamps = false;

    public function satellite()
    {
        return $this->belongsTo(Satellite::class, 'sat_id');
    }
}

