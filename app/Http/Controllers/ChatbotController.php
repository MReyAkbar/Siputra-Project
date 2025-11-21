<?php

namespace App\Http\Controllers;

use App\Services\RagService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    protected RagService $ragService;

    public function __construct(RagService $ragService)
    {
        $this->ragService = $ragService;
    }

    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = $request->input('message');

        // Retrieve relevant documents using RAG
        $relevantDocs = $this->ragService->retrieveRelevantDocuments($message, 3);

        // Build context from relevant documents
        $context = $this->buildContext($relevantDocs);

        // If no relevant documents found, return "not found" message
        if (empty($context)) {
            return response()->json([
                'reply' => 'Maaf, saya tidak menemukan informasi tentang itu dalam basis pengetahuan saya. Silakan hubungi tim support kami untuk bantuan lebih lanjut atau coba tanyakan pertanyaan yang lebih spesifik.',
                'sources_used' => 0,
                'rag_enabled' => true
            ]);
        }

        // Build the strict prompt (only answer from documents)
        $enhancedPrompt = $this->buildStrictPrompt($message, $context);

        $apiKey = config('gemini.api_key');
        $model  = config('gemini.model', 'gemini-2.0-flash-lite');
        $url    = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";

        try {
            $response = Http::post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $enhancedPrompt]
                        ]
                    ]
                ]
            ]);

            if ($response->failed()) {
                Log::error('Gemini API Error: ' . $response->body());
                return response()->json([
                    'reply' => 'Saporah, abhulong dhari otakka, sake\' ta\' bisa ajhega. Monggo e-oba pole dhari gi\' bu-lagi.'
                ], 500);
            }

            $data = $response->json();

            // Extract the text safely
            $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'No response received.';

            return response()->json([
                'reply' => $reply,
                'sources_used' => count($relevantDocs),
                'rag_enabled' => true
            ]);

        } catch (\Exception $e) {
            Log::error('Gemini API Exception: ' . $e->getMessage());

            return response()->json([
                'reply' => 'Saporah, abhulong dhari otakka, sake\' ta\' bisa ajhega. Monggo e-oba pole dhari gi\' bu-lagi.'
            ], 500);
        }
    }

    /**
     * Build context string from relevant documents
     */
    private function buildContext(array $documents): string
    {
        if (empty($documents)) {
            return '';
        }

        $contextParts = [];
        foreach ($documents as $index => $doc) {
            $contextParts[] = "Document " . ($index + 1) . ":\n" . $doc['content'];
        }

        return implode("\n\n", $contextParts);
    }

    /**
     * Build strict prompt - ONLY answer from provided documents
     */
    private function buildStrictPrompt(string $userMessage, string $context): string
    {
        return <<<PROMPT
Anda adalah asisten AI yang HANYA menjawab berdasarkan dokumentasi yang diberikan.

ATURAN PENTING:
1. HANYA gunakan informasi dari Context di bawah ini
2. JANGAN gunakan pengetahuan umum Anda
3. JANGAN membuat asumsi di luar Context
4. Jika Context tidak cukup untuk menjawab, katakan: "Maaf, informasi tersebut tidak tersedia dalam basis pengetahuan saya."
5. Jawab dalam bahasa Indonesia yang jelas dan profesional
6. Sebutkan sumber dokumen jika relevan (misalnya: "Menurut dokumentasi kami...")

Context (Basis Pengetahuan):
{$context}

Pertanyaan User: {$userMessage}

Jawaban (HANYA berdasarkan Context di atas):
PROMPT;
    }

    /**
     * Upload and index documents for RAG
     */
    public function uploadDocument(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'title' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
        ]);

        $content = $request->input('content');
        $metadata = [
            'title' => $request->input('title'),
            'category' => $request->input('category'),
        ];

        $success = $this->ragService->addDocument($content, $metadata);

        if ($success) {
            return response()->json([
                'message' => 'Document added successfully',
                'total_documents' => $this->ragService->getDocumentCount()
            ]);
        }

        return response()->json([
            'message' => 'Failed to add document'
        ], 500);
    }

    /**
     * Get RAG statistics
     */
    public function stats()
    {
        return response()->json([
            'total_documents' => $this->ragService->getDocumentCount(),
            'rag_enabled' => true
        ]);
    }

    /**
     * Clear all documents
     */
    public function clearDocuments()
    {
        $success = $this->ragService->clearDocuments();

        return response()->json([
            'message' => $success ? 'All documents cleared' : 'Failed to clear documents',
            'success' => $success
        ]);
    }
}