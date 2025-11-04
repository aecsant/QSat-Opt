<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class SatelliteController extends Controller
{
    public function index()
    {
        $sats = DB::table('satellites')->get();
        $windows = DB::table('optimized_windows')->orderBy('priority_score','desc')->get();
        return view('dashboard', compact('sats','windows'));
    }
}

