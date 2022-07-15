<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/home', [App\Http\Controllers\ProviderController::class, 'index'])->name('home');
    Route::post('/provider', [App\Http\Controllers\ProviderController::class, 'store'])->name('add');
    Route::put('/provider/{id}', [App\Http\Controllers\ProviderController::class, 'update'])->name('edit');
    Route::delete('/provider/{id}',[App\Http\Controllers\ProviderController::class, 'destroy'])->name('delete');
});