<?php

use App\Http\Controllers\CategoryController;
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

Route::get('/', [CategoryController::class, 'index'])->name('category.index');

// category route
Route::controller(CategoryController::class)->prefix('category')->name('category.')->group(function () {
    Route::get('/create', 'createView')->name('create.view');
    Route::post('/create', 'createAction')->name('create.action');
    Route::get('/update/{slug}', 'updateView')->name('update.view');
    Route::put('/update/{slug}', 'updateAction')->name('update.action');
    Route::get('/delete/{slug}', 'delete')->name('delete');
});
