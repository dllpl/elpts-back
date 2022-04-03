<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/order/create', [OrderController::class, 'store']);

Route::any('/pay', [PaymentController::class, 'payCreate'])->name('pay.create');
Route::any('/pay/callback', [PaymentController::class, 'payCallback'])->name('pay.callback');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', function (Request $request) {return $request->user();});

    Route::get('/orders/all', [OrderController::class, 'index']);
});




