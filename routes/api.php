<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SensorController;
use App\Http\Controllers\Api\LampController;
use App\Http\Controllers\Api\SensorLogController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\DeviceController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Route Auth
Route::prefix('v1/auth')->name('auth.')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:sanctum');
});

//Route Sensor
Route::prefix('v1/sensors')->name('sensors.')->group(function () {
    Route::get('/', [SensorController::class, 'index'])->name('get');
    Route::post('/', [SensorController::class, 'store'])->name('store');
    Route::get('/{code}', [SensorController::class, 'show'])->name('details');
    Route::put('/{code}', [SensorController::class, 'update'])->name('update');
    Route::delete('/{code}', [SensorController::class, 'destroy'])->name('delete');
});

//Route Lamp
Route::prefix('v1/lamps')->name('lamps.')->group(function () {
    Route::get('/', [LampController::class, 'index'])->name('get');
    Route::post('/', [LampController::class, 'store'])->name('store');
    Route::post('/bulk', [LampController::class, 'bulkUpdate'])->name('bulk');
    Route::get('/{code}', [LampController::class, 'show'])->name('details');
    Route::put('/{code}', [LampController::class, 'update'])->name('update');
    Route::put('/{code}/customize', [LampController::class, 'updateCustomize'])->name('update.customize');
    Route::post('/{code}/toogle', [LampController::class, 'toggleStatus'])->name('toogle');
    Route::delete('/{code}', [LampController::class, 'destroy'])->name('delete');
});

//Route SensorLog
Route::prefix('v1/sensors')->name('sensor-logs.')->group(function () {
    Route::get('/{code}/logs', [SensorLogController::class, 'index'])->name('get');
    Route::get('/logs/value', [SensorLogController::class, 'getValue'])->name('get.value');
    Route::post('/logs', [SensorLogController::class, 'bulkInsert'])->name('bulk');
    Route::post('/{code}/logs', [SensorLogController::class, 'store'])->name('store');
    Route::delete('/{code}/logs', [SensorLogController::class, 'destroy'])->name('delete');
});

//Route User
Route::prefix('v1/users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('get');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/{id}', [UserController::class, 'show'])->name('details');
    Route::put('/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/', [UserController::class, 'destroy'])->name('delete');
});

//Route Device
Route::prefix('v1/devices')->name('devices.')->group(function () {
    Route::get('/', [DeviceController::class, 'index'])->name('get');
    Route::get('/{code}/ping', [DeviceController::class, 'ping'])->name('ping');
    Route::get('/json', [DeviceController::class, 'getJSON'])->name('get.json');
    Route::post('/', [DeviceController::class, 'store'])->name('store');
    Route::put('/{code}', [DeviceController::class, 'update'])->name('update');
    Route::delete('/{code}', [DeviceController::class, 'destroy'])->name('delete');
});

