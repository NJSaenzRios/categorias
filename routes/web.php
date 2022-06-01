<?php

use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

/* 
//Route::get('/categoria', function () {
    return view('categoria.index');
});



Route::get('categoria/create', [CategoriaController::class, "create"]);
*/

Route::resource("categoria", CategoriaController::class)->middleware('auth');

Auth::routes(['register'=>false, 'reset'=>false]);

Route::get('/home', [CategoriaController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'], function (){

    Route::get('/', [CategoriaController::class, 'index'])->name('home');
    

});
