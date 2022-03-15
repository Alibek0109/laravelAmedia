<?php

use App\Http\Controllers\ManagerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', [PageController::class, 'index'])->name('page.index')->middleware('guest');

Auth::routes();

Route::group(['middleware' => 'auth', 'prefix' => 'home'], function () {
    Route::group(['controller' => UserController::class, 'middleware' => 'user'], function () {
        Route::get('/', 'index')->name('home.user.index');
        Route::get('/create', 'create')->name('home.user.create');
        Route::get('/checked', 'checked')->name('home.user.checked');
        Route::post('/', 'store')->name('home.user.store');
        Route::get('/{id}/edit', 'edit')->name('home.user.edit');
        Route::put('/{id}', 'update')->name('home.user.update');
        Route::delete('/{id}', 'destroy')->name('home.user.destroy');
    });

    Route::group(['controller' => ManagerController::class, 'prefix' => 'manager', 'middleware' => 'manager'], function () {
        Route::get('/', 'index')->name('home.manager.index');
        Route::get('/checked', 'checked')->name('home.manager.checked');
        Route::post('/', 'store')->name('home.manager.store');
        Route::put('/{id}', 'update')->name('home.manager.update');
        Route::delete('/{id}', 'destroy')->name('home.manager.destroy');
    });
});
