<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('slings', 'Api\SlingsController@index');
// Route::get('sling/{barcode}', 'Api\SlingsController@getSlingByBarcode');

Route::middleware('auth:api')->group( function(){

    Route::get('assets', 'Api\AssetsController@index');
    Route::get('asset/{barcode}', 'Api\AssetsController@getAssetByBarcode');
    Route::post('asset/','Api\AssetsController@store');
    Route::put('asset/{barcode}', 'Api\AssetsController@update');

    
    Route::get('audit/{barcode}', 'Api\AuditController@getAssetByBarcode');
    Route::post('audit/', 'Api\AuditController@store');
    Route::put('audit/{barcode}', 'Api\AuditController@update');



});



