<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $message = $request->input('message');

        $apiKey = env('GEMINI_API_KEY');
        $model  = env('GEMINI_MODEL', 'gemini-2.0-flash-lite');
        $url    = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";

        try {
            $response = Http::post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $message]
                        ]
                    ]
                ]
            ]);

            if ($response->failed()) {
                Log::error('Gemini API Error: ' . $response->body());
                return response()->json([
                    'reply' => 'Sorry, I am having trouble connecting to my brain right now. Please try again later.'
                ], 500);
            }

            $data = $response->json();

            // Extract the text safely
            $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'No response received.';

            return response()->json([
                'reply' => $reply
            ]);

        } catch (\Exception $e) {
            Log::error('Gemini API Exception: ' . $e->getMessage());

            return response()->json([
                'reply' => 'Sorry, I am having trouble connecting to my brain right now. Please try again later.'
            ], 500);
        }
    }
}
