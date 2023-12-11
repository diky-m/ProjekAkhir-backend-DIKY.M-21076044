<?php

use App\Http\Controllers\ModulController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// routing modul
Route::get('/modul', [ModulController::class, 'index'])->name('modul.index');
Route::get('/modul/tambahdata', [ModulController::class, 'create'])->name('modul.create');
Route::get('/modul/edit/{id}', [ModulController::class, 'edit'])->name('modul.edit');
Route::post('/modul/store', [ModulController::class, 'store'])->name('modul.store');
Route::patch('/modul/update/{id}', [ModulController::class, 'update'])->name('modul.update');
Route::delete('/modul/delete/{id}', [ModulController::class, 'destroy'])->name('modul.destroy');
