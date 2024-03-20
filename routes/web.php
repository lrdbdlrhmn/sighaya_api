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

Route::resource('users', App\Http\Controllers\UserController::class);
Route::resource('states', App\Http\Controllers\StateController::class);

Route::resource('regions', App\Http\Controllers\RegionController::class);
Route::resource('cities', App\Http\Controllers\CityController::class);
Route::resource('reports', App\Http\Controllers\ReportController::class);
Route::resource('manager-regions', App\Http\Controllers\ManagerRegionController::class);

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('invoiceHtml/{id}', [App\Http\Controllers\Api\ImageController::class,'invoiceHtml']);