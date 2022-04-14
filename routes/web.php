<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
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
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [OrderController::class, 'index'])
    ->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/order/{id}', [OrderController::class, 'show'])->name('order_show');
Route::middleware(['auth:sanctum', 'verified'])->any('/order/destroy/{id}', [OrderController::class, 'destroy'])->name('order_destroy');

Route::middleware(['auth:sanctum', 'verified'])->post('/order/{id}', [OrderController::class, 'update'])->name('status_edit');



