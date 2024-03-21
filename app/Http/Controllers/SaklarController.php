<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lamp;
class SaklarController extends Controller
{
    public function index(){
        $lamps = Lamp::all();

        $data = [
            'lamps' => $lamps,
        ];

        return view('pages.saklar', $data);
    }

    public function edit(){

    }

    public function custom($code)
    {
        $lamp = Lamp::where('code', $code)->first();

        $data = [
            'lamp' => $lamp
        ];

        return view('pages.modecustom', $data);
    }
}

