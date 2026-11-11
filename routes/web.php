<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\SSEController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/send-message', [MessageController::class, 'sendMsg'])->name('message.store');
Route::get('/sse-updates', [SSEController::class, 'sendSSE'])->name('sse.updates');