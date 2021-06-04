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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [App\Http\Controllers\APIController::class, 'login']);

Route::get('logout', [App\Http\Controllers\APIController::class, 'logout']);

Route::group(['middleware' => 'auth.jwt','prefix' => 'v1'], function(){

	Route::get(	'funcionarios', 
					[App\Http\Controllers\FuncionarioController::class, 'index']);
	Route::post( 'funcionarios',
					[App\Http\Controllers\FuncionarioController::class, 'store']);
	Route::delete( 'funcionarios/{id}',
					[App\Http\Controllers\FuncionarioController::class, 'destroy']);
	Route::get( 'funcionarios/{id}',
					[App\Http\Controllers\FuncionarioController::class, 'show']);
	Route::put( 'funcionarios/{id}', 
					[App\Http\Controllers\FuncionarioController::class, 'update']);
});
