<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satellite extends Model
{
    use HasFactory;

    protected $table = 'satellites';

    protected $fillable = [
        'name',
        'tle_line1',
        'tle_line2',
    ];

    public $timestamps = false;

    public function passes()
    {
        return $this->hasMany(Pass::class, 'sat_id');
    }

    public function optimizedWindows()
    {
        return $this->hasMany(OptimizedWindow::class, 'sat_id');
    }
}

