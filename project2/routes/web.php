<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BiodataController;
use App\Http\Controllers\DashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index']);

// biodata
Route::get('/biodata', [BiodataController::class, 'index']);
Route::get('/biodata/create', [BiodataController::class, 'create']);
Route::post('/biodata', [BiodataController::class, 'store']);
Route::get('/biodata/{id}/edit', [BiodataController::class, 'edit']);
Route::put('/biodata/{id}', [BiodataController::class, 'update']);
Route::get('/biodata/{id}/delete', [BiodataController::class, 'destroy']);

Route::get('/findkabkotaname', [BiodataController::class, 'findkabkotaname']);
Route::get('/findkecname', [BiodataController::class, 'findkecname']);