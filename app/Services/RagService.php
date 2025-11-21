<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class RagService
{
    private string $apiKey;
    private string $embeddingModel = 'text-embedding-004';
    private string $storageFile = 'rag/documents.json';

    public function __construct()
    {
        $this->apiKey = config('gemini.api_key');
    }

    /**
     * Add a document to the RAG knowledge base
     */
    public function addDocument(string $content, array $metadata = []): bool
    {
        try {
            // Generate embedding for the document
            $embedding = $this->generateEmbedding($content);
            
            if (!$embedding) {
                return false;
            }

            // Load existing documents
            $documents = $this->loadDocuments();

            // Add new document
            $documents[] = [
                'id' => uniqid('doc_', true),
                'content' => $content,
                'embedding' => $embedding,
                'metadata' => $metadata,
                'created_at' => now()->toIso8601String(),
            ];

            // Save documents
            return $this->saveDocuments($documents);

        } catch (\Exception $e) {
            Log::error('RAG Add Document Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Retrieve relevant documents based on query
     */
    public function retrieveRelevantDocuments(string $query, int $topK = 3): array
    {
        try {
            // Generate embedding for the query
            $queryEmbedding = $this->generateEmbedding($query);
            
            if (!$queryEmbedding) {
                return [];
            }

            // Load all documents
            $documents = $this->loadDocuments();

            if (empty($documents)) {
                return [];
            }

            // Calculate similarity scores
            $scoredDocuments = [];
            foreach ($documents as $doc) {
                $similarity = $this->cosineSimilarity($queryEmbedding, $doc['embedding']);
                $scoredDocuments[] = [
                    'document' => $doc,
                    'score' => $similarity,
                ];
            }

            // Sort by similarity score (descending)
            usort($scoredDocuments, fn($a, $b) => $b['score'] <=> $a['score']);

            // Return top K documents
            return array_slice(array_map(fn($item) => $item['document'], $scoredDocuments), 0, $topK);

        } catch (\Exception $e) {
            Log::error('RAG Retrieve Error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Generate embedding using Gemini API
     */
    private function generateEmbedding(string $text): ?array
    {
        $url = "https://generativelanguage.googleapis.com/v1beta/models/{$this->embeddingModel}:embedContent?key={$this->apiKey}";

        try {
            $response = Http::post($url, [
                'model' => "models/{$this->embeddingModel}",
                'content' => [
                    'parts' => [
                        ['text' => $text]
                    ]
                ]
            ]);

            if ($response->failed()) {
                Log::error('Gemini Embedding API Error: ' . $response->body());
                return null;
            }

            $data = $response->json();
            return $data['embedding']['values'] ?? null;

        } catch (\Exception $e) {
            Log::error('Gemini Embedding Exception: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Calculate cosine similarity between two vectors
     */
    private function cosineSimilarity(array $vec1, array $vec2): float
    {
        $dotProduct = 0.0;
        $magnitude1 = 0.0;
        $magnitude2 = 0.0;

        $count = min(count($vec1), count($vec2));

        for ($i = 0; $i < $count; $i++) {
            $dotProduct += $vec1[$i] * $vec2[$i];
            $magnitude1 += $vec1[$i] ** 2;
            $magnitude2 += $vec2[$i] ** 2;
        }

        $magnitude1 = sqrt($magnitude1);
        $magnitude2 = sqrt($magnitude2);

        if ($magnitude1 == 0 || $magnitude2 == 0) {
            return 0.0;
        }

        return $dotProduct / ($magnitude1 * $magnitude2);
    }

    /**
     * Load documents from storage
     */
    private function loadDocuments(): array
    {
        if (!Storage::exists($this->storageFile)) {
            return [];
        }

        $content = Storage::get($this->storageFile);
        return json_decode($content, true) ?? [];
    }

    /**
     * Save documents to storage
     */
    private function saveDocuments(array $documents): bool
    {
        $json = json_encode($documents, JSON_PRETTY_PRINT);
        return Storage::put($this->storageFile, $json);
    }

    /**
     * Clear all documents
     */
    public function clearDocuments(): bool
    {
        return Storage::delete($this->storageFile);
    }

    /**
     * Get document count
     */
    public function getDocumentCount(): int
    {
        return count($this->loadDocuments());
    }
}