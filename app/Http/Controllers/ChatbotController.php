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

        // If no relevant documents found, return custom message
        if (empty($context)) {
            return response()->json([
                'reply' => 'Maaf, saat ini saya tidak bisa menjawab pertanyaan tersebut. Untuk informasi lebih lanjut, silakan hubungi admin kami via WhatsApp dengan menekan tombol di pojok kanan bawah.',
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
                    'reply' => 'Maaf, terjadi kesalahan sistem. Silakan coba lagi atau hubungi admin kami via WhatsApp dengan menekan tombol di pojok kanan bawah.'
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
                'reply' => 'Maaf, terjadi kesalahan sistem. Silakan coba lagi atau hubungi admin kami via WhatsApp dengan menekan tombol di pojok kanan bawah.'
            ], 500);
        }
    }

    /**
     * Build context string from relevant documents WITHOUT document labels
     */
    private function buildContext(array $documents): string
    {
        if (empty($documents)) {
            return '';
        }

        $contextParts = [];
        foreach ($documents as $doc) {
            // Just add content without "Document 1", "Document 2" labels
            $contextParts[] = trim($doc['content']);
        }

        return implode("\n\n", $contextParts);
    }

    /**
     * Build strict prompt - Answer naturally without mentioning documents
     */
    private function buildStrictPrompt(string $userMessage, string $context): string
    {
        return <<<PROMPT
Anda adalah asisten AI customer service untuk PT Putra Samudera Nusantara yang ramah dan profesional.

ATURAN PENTING:
1. HANYA gunakan informasi dari Basis Pengetahuan di bawah ini untuk menjawab
2. JANGAN gunakan pengetahuan umum atau informasi di luar Basis Pengetahuan
3. JANGAN menyebut "Document 1", "Document 2", "Document 3", atau referensi dokumen apapun
4. Jawab dengan NATURAL dan CONVERSATIONAL, seolah-olah Anda sedang berbicara langsung dengan customer
5. Gunakan bahasa Indonesia yang ramah, jelas, dan profesional
6. Jika informasi tidak lengkap di Basis Pengetahuan, katakan: "Maaf, untuk informasi lebih detail tentang hal tersebut, silakan hubungi admin kami via WhatsApp dengan menekan tombol di pojok kanan bawah."
7. Jangan sebutkan bahwa Anda menggunakan "basis pengetahuan" atau "dokumentasi"
8. Berikan jawaban yang lengkap dan informatif

Basis Pengetahuan:
{$context}

Pertanyaan Customer: {$userMessage}

Jawaban (Natural dan tanpa menyebut sumber dokumen):
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