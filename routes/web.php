<?php

use Illuminate\Support\Facades\Route;
use App\Events\ChatEvent;
use Illuminate\Http\Request;

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

Route::get('export_user_pdf', [App\Http\Controllers\PDFController::class, 'export_user_pdf'])->name('export_user_pdf');

Route::get('/message/{id}', [App\Http\Controllers\HomeController::class, 'getMessage'])->name('message');

Route::post('message', [App\Http\Controllers\HomeController::class, 'sendMessage']);