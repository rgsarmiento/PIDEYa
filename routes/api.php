<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//iniciamos aca
 Route::post('/customers', 'App\Http\Controllers\CustomerController@store');
 Route::post('/products', 'App\Http\Controllers\PoductController@store'); 
 Route::get('/documents/{id}', 'App\Http\Controllers\DocumentController@show'); 
 Route::post('/documents/delete/{id}', 'App\Http\Controllers\DocumentController@destroy'); 

// Route::prefix('pideya')->group(function () {
//     Route::post('/customers', 'App\Http\Controllers\CustomerController@store');
//     Route::post('/products', 'App\Http\Controllers\ProductController@store'); 
//     Route::get('/documents/{id}', 'App\Http\Controllers\DocumentController@show'); 
//     Route::post('/documents/delete/{id}', 'App\Http\Controllers\DocumentController@destroy'); 
// });