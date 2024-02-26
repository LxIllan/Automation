<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('customers', App\Http\Controllers\CustomerController::class)->except(['show']);
    Route::resource('inventories', App\Http\Controllers\InventoryController::class);
    Route::resource('inventory-items', App\Http\Controllers\InventoryItemController::class)->except(['create']);
    Route::get('inventory-items/create/{inventory}', [App\Http\Controllers\InventoryItemController::class, 'create'])->name('inventory-items.create');
    Route::resource('workers', App\Http\Controllers\WorkerController::class);
    Route::resource('projects', App\Http\Controllers\ProjectController::class);
    Route::resource('pieces-category', App\Http\Controllers\PieceCategoryController::class);
    Route::resource('pieces', App\Http\Controllers\PieceController::class);
});
