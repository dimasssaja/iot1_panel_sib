<?php

use App\Http\Controllers\DeviceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SaklarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard');
    Route::get('/dokumentasi', 'dokumentasi')->name('dokumentasi');
});
Route::controller(UserController::class)->group(function () {
    Route::get('/user', 'index')->name('user');
});
Route::controller(DeviceController::class)->group(function () {
    Route::get('/device', 'index')->name('device');
});
Route::controller(SaklarController::class)->group(function () {
    Route::get('/saklar', 'index')->name('saklar');
    Route::get('/custom/{code}', 'custom')->name('custom');
});
Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index')->name('login');
});

