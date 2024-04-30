<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemperatureController extends Controller
{
    //
    function index(){
        return view('pages.temperature');
    }
}
