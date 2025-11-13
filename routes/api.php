use App\Http\Controllers\ChatbotController;

Route::post('/chat', [ChatbotController::class, 'chat']);