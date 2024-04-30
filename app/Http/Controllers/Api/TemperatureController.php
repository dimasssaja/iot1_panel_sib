<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Temperature;
use Illuminate\Http\Request;

class TemperatureController extends Controller
{
    //
    function index(){
        $temperatures = Temperature::orderBy('created_at','desc')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'List Data Temperature',
            'data' => $temperatures
        ]);
    }

    public function store(Request $request){
        $value = $request->input('value');

        $temperatures = Temperature::create([
             'value' =>$value
        ]);

        // $temperatures = new Temperature();
        // $temperatures->value = $value;
        // $temperatures->save();
        return response()->json([
            'status' => 'success',
            'message' => ' Data Temperature berhasil disimpan',
            'data' => $temperatures
        ]);
        
    }
}
