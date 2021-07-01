<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\hapeController;

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

Route::get('/home', [hapeController::class, 'home'])->name('home')->middleware('auth');

Route::get('/form-tambah', function () {
    return view('form-tambah');
})->middleware('auth');

Route::post('/tambah', [hapeController::class, 'tambah'])->middleware('auth');
Route::get('/hapus-hape/{id}', [hapeController::class, 'hapus'])->middleware('auth');
Route::get('/ubah-hape/{id}', [hapeController::class, 'formUbah'])->middleware('auth');
Route::post('/ubah-hape', [hapeController::class, 'ubah'])->middleware('auth');
Route::get('/download-pdf', [hapeController::class, 'downloadPDF']);
