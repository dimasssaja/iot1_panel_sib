<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sensor;
use App\Models\SensorLog;
use Carbon\Carbon;
use DateTimeZone;
class DashboardController extends Controller
{
    public function index(Request $request){
        $sensor = Sensor::all();
        $data = [
            'sensors' => $sensor,
        ];

        return view('pages.dashboard', $data);
    }

    public function dokumentasi()
    {
        return view('pages.dokumentasi');
    }
}
