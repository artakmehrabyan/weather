<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherAlertController;
use App\Http\Controllers\UserPreferenceController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



Route::middleware('auth')->group(function () {
//    Route::get('/dashboard', function () {
//        return view('dashboard');
//    });

    Route::put('/user/preferences', [UserPreferenceController::class, 'update'])->name('user.preferences.update');
    Route::post('/weather/check', [WeatherAlertController::class, 'checkWeather'])->name('weather.check');
});
