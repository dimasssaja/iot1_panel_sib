<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
class DeviceController extends Controller
{
    public function index(){
        $device = Device::all();
        $data = [
            'device' => $device,
        ];
        return view('pages.device', $data);
    }
}
