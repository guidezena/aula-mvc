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
Route::get('/avisos', function () {
    return view('avisos',
                ['nome'=>'Perry',
                'mostrar'=>true,
                'avisos'=>[['id'=> 1, 'texto' => 'Feriados agora' ],
                ['id'=> 2, 'texto'=>'Feriado semana que vem']]]);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'clientes'], function(){

    Route::get('/listar', [App\Http\Controllers\ClientesController::class, 'listar'
    ])->middleware('auth');
});
