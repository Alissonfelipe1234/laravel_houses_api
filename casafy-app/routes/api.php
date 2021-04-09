<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('users', OwnerController::class);
Route::apiResource('homes', HomeController::class);
Route::get('/all_properties/{user_id}', [HomeController::class, 'get_all_properties'])->name('user.all_properties');
Route::patch('/change_purcharsed/{home_id}/to/{purcharsed}', [HomeController::class, 'change_purcharsed'])->name('home.change_purcharsed');
