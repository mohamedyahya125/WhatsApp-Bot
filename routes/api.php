<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UnavailableSlotController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WhatsappCustomerController;
use App\Http\Controllers\WorkingHourController;
use App\Http\Controllers\TelegramWebhookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/logout/{id}', [UserController::class, 'logout']);
    Route::get('/user/{id}', [UserController::class, 'show']);
});
Route::prefix('booking')->group(function () {
    Route::post('/', [BookingController::class, 'store']);
    Route::get('/', [BookingController::class, 'index']);
    Route::get('/{id}', [BookingController::class, 'show']);
    Route::put('/{id}', [BookingController::class, 'update']);
    Route::delete('/{id}', [BookingController::class, 'destroy']);
});
Route::prefix('business')->group(function () {
    Route::post('/', [BusinessController::class, 'store']);
    Route::get('/', [BusinessController::class, 'index']);
    Route::get('/{id}', [BusinessController::class, 'show']);
    Route::put('/{id}', [BusinessController::class, 'update']);
    Route::delete('/{id}', [BusinessController::class, 'destroy']);
});
Route::prefix('employee')->group(function () {
    Route::post('/', [EmployeeController::class, 'store']);
    Route::get('/', [EmployeeController::class, 'index']);
    Route::get('/{id}', [EmployeeController::class, 'show']);
    Route::put('/{id}', [EmployeeController::class, 'update']);
    Route::delete('/{id}', [EmployeeController::class, 'destroy']);
});
Route::prefix('payment')->group(function () {
    Route::post('/', [PaymentController::class, 'store']);
    Route::post('/process', [PaymentController::class, 'processPayment']);
    Route::get('/', [PaymentController::class, 'index']);
    Route::get('/{id}', [PaymentController::class, 'show']);
    Route::put('/{id}', [PaymentController::class, 'update']);
    Route::delete('/{id}', [PaymentController::class, 'destroy']);
});
Route::prefix('service')->group(function () {
    Route::post('/', [ServiceController::class, 'store']);
    Route::get('/', [ServiceController::class, 'index']);
    Route::get('/{id}', [ServiceController::class, 'show']);
    Route::put('/{id}', [ServiceController::class, 'update']);
    Route::delete('/{id}', [ServiceController::class, 'destroy']);
});
Route::prefix('unavailable')->group(function () {
    Route::post('/', [UnavailableSlotController::class, 'store']);
    Route::get('/', [UnavailableSlotController::class, 'index']);
    Route::get('/{id}', [UnavailableSlotController::class, 'show']);
    Route::put('/{id}', [UnavailableSlotController::class, 'update']);
    Route::delete('/{id}', [UnavailableSlotController::class, 'destroy']);
});
Route::prefix('whatsapp')->group(function () {
    Route::post('/', [WhatsappCustomerController::class, 'store']);
    Route::get('/', [WhatsappCustomerController::class, 'index']);
    Route::get('/{id}', [WhatsappCustomerController::class, 'show']);
    Route::put('/{id}', [WhatsappCustomerController::class, 'update']);
    Route::delete('/{id}', [WhatsappCustomerController::class, 'destroy']);
});
Route::prefix('working')->group(function () {
    Route::post('/', [WorkingHourController::class, 'store']);
    Route::get('/', [WorkingHourController::class, 'index']);
    Route::get('/{id}', [WorkingHourController::class, 'show']);
    Route::put('/{id}', [WorkingHourController::class, 'update']);
    Route::delete('/{id}', [WorkingHourController::class, 'destroy']);
});
Route::post('/webhook/telegram', [TelegramWebhookController::class, 'webhook']);
