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

Route::prefix('task')->group(function () {
    Route::get('/', [
        'uses' => 'TaskController@index',
        'nocsrf' => true
    ]);
    Route::get('/{id}', [
        'uses' => 'TaskController@get',
        'nocsrf' => true
    ]);
    Route::post('/', [
        'uses' => 'TaskController@create',
        'nocsrf' => true
    ]);
    Route::put('/{id}', [
        'uses' => 'TaskController@update',
        'nocsrf' => true
    ]);
    Route::delete('/{id}', [
        'uses' => 'TaskController@delete',
        'nocsrf' => true
    ]);
});
