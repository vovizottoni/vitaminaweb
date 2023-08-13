<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();




Route::middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');    
    Route::get('/oportunidade/create', [App\Http\Controllers\HomeController::class, 'create'])->name('oportunidade-create');    
    Route::post('/oportunidade/store', [App\Http\Controllers\HomeController::class, 'store'])->name('oportunidade-store');
    Route::get('/oportunidade/aprove/{id}', [App\Http\Controllers\HomeController::class, 'aprove'])->name('oportunidade-aprove');    
    Route::get('/oportunidade/refuse/{id}', [App\Http\Controllers\HomeController::class, 'refuse'])->name('oportunidade-refuse');    


    Route::get('/autocompletevendedor', [App\Http\Controllers\HomeController::class, 'autocompletevendedor'])->name('autocompletevendedor');     
    Route::get('/autocompletecliente', [App\Http\Controllers\HomeController::class, 'autocompletecliente'])->name('autocompletecliente'); 
    Route::get('/autocompleteprodutos', [App\Http\Controllers\HomeController::class, 'autocompleteprodutos'])->name('autocompleteprodutos'); 
    

});

