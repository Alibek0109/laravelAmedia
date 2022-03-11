<?php

use App\Http\Controllers\ManagerController;
use App\Http\Controllers\UserController;
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

Route::get('/', [PageController::class, 'index'])->name('page.index')->middleware('guest');

Auth::routes();

Route::group(['middleware' => 'auth', 'prefix' => 'home'], function () {
    Route::group(['controller' => UserController::class, 'middleware' => 'user'], function () {
        Route::get('/', 'index')->name('home.user.index');
        Route::post('/', 'store')->name('home.user.store');
    });
    Route::group(['controller' => ManagerController::class, 'prefix' => 'manager', 'middleware' => 'manager'], function () {
        Route::get('/', 'index')->name('home.manager.index');
    });
});
