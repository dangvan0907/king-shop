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

Route::prefix('users')
    ->middleware('auth')
    ->name('users.')
    ->group(function () {
        Route::get('/',
            [\App\Http\Controllers\UserController::class, 'index'])
            ->name('index')
            ->middleware('check.permission:index-user');

        Route::get('/{user}/show',
            [\App\Http\Controllers\UserController::class, 'show'])
            ->name('show')
            ->middleware('check.permission:show-user');

        Route::get('/{user}/edit',
            [\App\Http\Controllers\UserController::class, 'edit'])
            ->name('edit')
            ->middleware('check.permission:edit-user');
        Route::put('/{user}/update',
            [\App\Http\Controllers\UserController::class, 'update'])
            ->name('update')
            ->middleware('check.permission:update-user');

        Route::get('/create',
            [\App\Http\Controllers\UserController::class, 'create'])
            ->name('create')
            ->middleware('check.permission:create-user');
        Route::post('/',
            [\App\Http\Controllers\UserController::class, 'store'])
            ->name('store')
            ->middleware('check.permission:store-user');

        Route::delete('/{user}',
            [\App\Http\Controllers\UserController::class, 'destroy'])
            ->name('destroy')
            ->middleware('check.permission:delete-user');
    });
Route::prefix('roles')
    ->middleware('auth')
    ->name('roles.')
    ->group(function () {
        Route::get('/',
            [\App\Http\Controllers\RoleController::class, 'index'])
            ->name('index')
            ->middleware('check.permission:index-role');
        Route::get('/{role}/show',
            [\App\Http\Controllers\RoleController::class, 'show'])
            ->name('show')
            ->middleware('check.permission:show-role');

        Route::get('/{role}/edit',
            [\App\Http\Controllers\RoleController::class, 'edit'])
            ->name('edit')
            ->middleware('check.permission:edit-role');
        Route::put('/{role}/update',
            [\App\Http\Controllers\RoleController::class, 'update'])
            ->name('update')
            ->middleware('check.permission:update-role');

        Route::get('/create',
            [\App\Http\Controllers\RoleController::class, 'create'])
            ->name('create')
            ->middleware('check.permission:create-role');
        Route::post('/',
            [\App\Http\Controllers\RoleController::class, 'store'])
            ->name('store')
            ->middleware('check.permission:store-role');

        Route::delete('/{role}',
            [\App\Http\Controllers\RoleController::class, 'destroy'])
            ->name('destroy')
            ->middleware('check.permission:delete-role');

    });

Route::prefix('products')
    ->middleware('auth')
    ->name('products.')
    ->group(function () {
        Route::get('/',
            [\App\Http\Controllers\ProductController::class, 'index'])
            ->name('index')
            ->middleware('check.permission:index-product');

        Route::get('/list',
            [\App\Http\Controllers\ProductController::class, 'list'])
            ->name('list')
            ->middleware('check.permission:index-product');

        Route::get('/{role}/show',
            [\App\Http\Controllers\ProductController::class, 'show'])
            ->name('show')
            ->middleware('check.permission:show-product');

        Route::get('/{role}/edit',
            [\App\Http\Controllers\ProductController::class, 'edit'])
            ->name('edit')
            ->middleware('check.permission:edit-product');

        Route::put('/{role}/update',
            [\App\Http\Controllers\ProductController::class, 'update'])
            ->name('update')
            ->middleware('check.permission:update-product');

        Route::get('/create',
            [\App\Http\Controllers\ProductController::class, 'create'])
            ->name('create')
            ->middleware('check.permission:create-product');

        Route::post('/',
            [\App\Http\Controllers\ProductController::class, 'store'])
            ->name('store')
            ->middleware('check.permission:store-product');

        Route::delete('/{product}',
            [\App\Http\Controllers\ProductController::class, 'destroy'])
            ->name('destroy')
            ->middleware('check.permission:delete-product');

    });

Route::prefix('categories')
    ->middleware('auth')
    ->name('categories.')
    ->group(function () {
        Route::get('/',
            [\App\Http\Controllers\CategoryController::class, 'index'])
            ->name('index')
            ->middleware('check.permission:index-category');
        Route::get('/children',
            [\App\Http\Controllers\CategoryController::class, 'children'])
            ->name('children')
            ->middleware('check.permission:index-category');


        Route::get('/{role}/show',
            [\App\Http\Controllers\CategoryController::class, 'show'])
            ->name('show')
            ->middleware('check.permission:show-category');

        Route::get('/{category}/edit',
            [\App\Http\Controllers\CategoryController::class, 'edit'])
            ->name('edit')
            ->middleware('check.permission:edit-category');

        Route::put('/{category}/update',
            [\App\Http\Controllers\CategoryController::class, 'update'])
            ->name('update')
            ->middleware('check.permission:update-category');

        Route::get('/create',
            [\App\Http\Controllers\CategoryController::class, 'create'])
            ->name('create')
            ->middleware('check.permission:create-category');

        Route::post('/',
            [\App\Http\Controllers\CategoryController::class, 'store'])
            ->name('store')
            ->middleware('check.permission:store-category');

        Route::delete('/{category}',
            [\App\Http\Controllers\CategoryController::class, 'destroy'])
            ->name('destroy')
            ->middleware('check.permission:delete-category');

    });


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
