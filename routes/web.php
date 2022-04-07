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

Auth::routes();

Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [\App\Http\Controllers\UserController::class, 'index'])->name('index');

    Route::get('/{user}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('edit');
    Route::put('/{user}/update', [\App\Http\Controllers\UserController::class, 'update'])->name('update');

    Route::get('/create', [\App\Http\Controllers\UserController::class, 'create'])->name('create');
    Route::post('/', [\App\Http\Controllers\UserController::class, 'store'])->name('store');

    Route::delete('/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('destroy');

});
