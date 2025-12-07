<?php

declare(strict_types=1);

return [
    /**
     * Gemini API Key
     *
     * You will need an API key to access the Gemini API.
     * You can obtain it from Google AI Studio ( https://makersuite.google.com/ )
     */
    'api_key' => env('GEMINI_API_KEY'),

    /**
     * Default Gemini Model
     *
     * Specify the default model to use for generateContent requests.
     * We are setting it to 'gemini-1.5-flash' to avoid the 'gemini-pro' not found error.
     */
    'model' => env('GEMINI_MODEL', 'gemini-2.5-flash-lite'),

    /**
     * Gemini Base URL
     *
     * If you need a specific base URL for the Gemini API, you can provide it here.
     * Otherwise, leave empty to use the default value.
     */
    'base_url' => env('GEMINI_BASE_URL'),
];