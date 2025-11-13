<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GeminiAPI\Laravel\Facades\Gemini; // <-- The fix is on this line

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        // Validate the user's message
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $message = $request->input('message');

        // Send the message to the Gemini API
        // We use 'gemini-1.5-flash' for the fast, free model
        $result = Gemini::gemini('gemini-1.5-flash')
                        ->generateContent($message);

        // Return the AI's response as JSON
        return response()->json([
            'reply' => $result->text()
        ]);
    }
}