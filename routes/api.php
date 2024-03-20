<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Auth\CodeCheckController;
//use App\Http\Controllers\Auth\ResetPasswordController;
//use App\Http\Controllers\Auth\ForgotPasswordController;

 // Password reset routes
//Route::post('password/email',  ForgotPasswordController::class);
//Route::post('password/code/check', CodeCheckController::class);
//Route::post('password/reset', ResetPasswordController::class);

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

Route::middleware("localization")->group(function () {


    
    Route::get('header/{vref}', [App\Http\Controllers\Api\ApiController::class,'header']);
    Route::get('details/{vref}', [App\Http\Controllers\Api\ApiController::class,'details']);
    Route::get('home', [App\Controllers\Api\HomeController::class,'index']);
    Route::controller(App\Http\Controllers\Api\AuthController::class)->group(function(){

        Route::post('register', 'register');
    
        Route::post('login', 'login');
    
    });
    

    
    Route::middleware("auth:sanctum")->group(function () {
        Route::controller(App\Http\Controllers\Api\AuthController::class)->group(function(){
            Route::get('check_balance/{id}', [App\Http\Controllers\Api\ImageController::class,'check_balance']);
    
            Route::get('invoice/{id}', [App\Http\Controllers\Api\ImageController::class,'invoiceHtml']);
            Route::post('reports', [App\Http\Controllers\Api\ReportController::class,'store']);
            Route::get('/', [App\Http\Controllers\Api\HomeController::class,'index']);
            Route::get('/reports', [App\Http\Controllers\Api\ReportController::class,'index']);

            Route::patch('/reports/{id}', [App\Http\Controllers\Api\ReportController::class,'update']);
            Route::patch('/reports/{id}/technical_update', [App\Http\Controllers\Api\ReportController::class,'technical_update']);


            Route::put('users/update', [App\Http\Controllers\Api\UserController::class,'update']);
            Route::get('users/{id}', [App\Http\Controllers\Api\UserController::class,'show']);
            Route::get('logout', 'logout');
            Route::delete('/delete_account', [App\Http\Controllers\Api\AuthController::class,'delete']);
            
            Route::post('password/forgot',  ForgotPasswordController::class);
            Route::post('password/forgot', [App\Http\Controllers\Api\ForgotPasswordController::class,'forgot']);
            Route::post('password/code/check', CodeCheckController::class);
            Route::post('password/reset', ResetPasswordController::class);

        
        });
        //Route::get('logout', 'logout');
        //Route::get('logout', App\Controllers\Api\AuthController::class);
        //Route::post('password/email',  App\Controllers\Api\ForgotPasswordController::class);
        //Route::post('password/code/check', App\Controllers\Api\CodeCheckController::class);
        //Route::post('password/reset', App\Controllers\Api\ResetPasswordController::class);

    
    });
});