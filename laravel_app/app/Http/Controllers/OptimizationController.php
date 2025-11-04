<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OptimizationController extends Controller
{
    public function optimize($id)
    {
        $url = "http://127.0.0.1:5005/optimize?sat_id=".$id;
        $response = Http::get($url);

        if ($response->successful()) {
            return redirect('/')->with('status', 'Optimization completed for satellite '.$id);
        } else {
            return redirect('/')->with('error', 'Python service unavailable');
        }
    }
}

