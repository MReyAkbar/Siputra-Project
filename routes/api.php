<?php

use App\Http\Controllers\ChatbotController;
use Illuminate\Support\Facades\Route; // <-- ADD THIS LINE

Route::post('/chat', [ChatbotController::class, 'chat']);