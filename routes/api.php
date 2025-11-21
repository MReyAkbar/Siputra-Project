<?php

use App\Http\Controllers\ChatbotController;
use Illuminate\Support\Facades\Route;

// Chatbot routes
Route::post('/chat', [ChatbotController::class, 'chat']);

// RAG management routes
Route::prefix('rag')->group(function () {
    Route::post('/upload', [ChatbotController::class, 'uploadDocument']);
    Route::get('/stats', [ChatbotController::class, 'stats']);
    Route::delete('/clear', [ChatbotController::class, 'clearDocuments']);
});
