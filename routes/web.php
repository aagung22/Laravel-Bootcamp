<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CafeController;
use App\Http\Controllers\PaymentController;

Route::get('/', [CafeController::class, 'index']);
Route::get('/menu', [CafeController::class, 'menu']);
Route::get('/order/dine-in', [CafeController::class, 'dineIn'])->name('order.dine-in');
Route::post('/order/store', [CafeController::class, 'storeOrder'])->name('order.store');

// ============================================
// ROUTE UNTUK PAYMENT MIDTRANS
// ============================================
Route::get('/payment/{order_code}', [PaymentController::class, 'show'])->name('payment.show');
Route::get('/payment/success/{order_id}', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/pending/{order_id}', [PaymentController::class, 'pending'])->name('payment.pending');
Route::get('/payment/error/{order_id}', [PaymentController::class, 'error'])->name('payment.error');
Route::post('/payment/notification', [PaymentController::class, 'notification'])->name('payment.notification');