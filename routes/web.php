<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
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

Route::get('/', [PageController::class, 'index'])->name('page.index');

Auth::routes();

Route::group(['middleware' => 'auth', 'prefix' => 'home'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::post('/', [HomeController::class, 'store'])->name('home.store');
});

