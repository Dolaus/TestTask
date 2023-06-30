<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::group(['prefix'=>'cars','namespace' => 'App\Http\Controllers\Cars','middleware'=>'api-session'],function (){
    Route::post('/', 'StoreController');

    Route::get('/'  , 'IndexController');

    Route::put('/{id}', 'UpdateController');

    Route::delete('/{id}', 'DestroyController');

    Route::get('/export', 'ExportController');

    Route::get('/updatebrandsmodels', 'UpdateBrandsModelsController');

    Route::get('/brands/{brand}/modelsAPI', 'GetModelsByBrandFromAPIController');
    Route::get('/brands/{brand}/modelsDatabase', 'GetModelsByBrandFromDatabaseController');
});

