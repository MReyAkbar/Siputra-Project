<?php

namespace App\Console\Commands;

use App\Services\RagService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class IndexDocumentsCommand extends Command
{
    protected $signature = 'rag:index 
                            {path : Path to directory or file to index}
                            {--chunk-size=500 : Maximum characters per chunk}
                            {--overlap=100 : Overlap between chunks}';

    protected $description = 'Index documents for RAG chatbot';

    protected RagService $ragService;

    public function __construct(RagService $ragService)
    {
        parent::__construct();
        $this->ragService = $ragService;
    }

    public function handle()
    {
        ini_set('memory_limit', '512M');
        
        $path = $this->argument('path');
        $chunkSize = (int) $this->option('chunk-size');
        $overlap = (int) $this->option('overlap');

        if (!File::exists($path)) {
            $this->error("Path does not exist: {$path}");
            return 1;
        }

        $this->info("Starting document indexing...");

        if (File::isDirectory($path)) {
            $this->indexDirectory($path, $chunkSize, $overlap);
        } else {
            $this->indexFile($path, $chunkSize, $overlap);
        }

        $this->info("\n✓ Indexing complete!");
        $this->info("Total documents: " . $this->ragService->getDocumentCount());

        return 0;
    }

    private function indexDirectory(string $path, int $chunkSize, int $overlap)
    {
        $files = File::allFiles($path);
        $bar = $this->output->createProgressBar(count($files));
        $bar->start();

        foreach ($files as $file) {
            if ($this->isSupportedFile($file->getExtension())) {
                $this->indexFile($file->getPathname(), $chunkSize, $overlap, false);
            }
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
    }

    private function indexFile(string $filePath, int $chunkSize, int $overlap, bool $showProgress = true)
    {
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        
        if (!$this->isSupportedFile($extension)) {
            if ($showProgress) {
                $this->warn("Unsupported file type: {$extension}");
            }
            return;
        }

        $content = File::get($filePath);
        $filename = basename($filePath);

        if ($showProgress) {
            $this->info("Indexing: {$filename}");
        }

        // Split content into chunks
        $chunks = $this->splitIntoChunks($content, $chunkSize);

        $successCount = 0;
        foreach ($chunks as $index => $chunk) {
            $metadata = [
                'filename' => $filename,
                'chunk_index' => $index,
                'total_chunks' => count($chunks),
                'file_path' => $filePath,
            ];

            $success = $this->ragService->addDocument($chunk, $metadata);

            if ($success) {
                $successCount++;
            } else {
                $this->error("Failed to index chunk {$index} of {$filename}");
            }
        }

        if ($showProgress) {
            $this->info("✓ Indexed {$filename} into {$successCount} chunks");
        }
    }

    private function splitIntoChunks(string $text, int $chunkSize): array
    {
        $text = trim($text);
        
        // If text is small enough, return as single chunk
        if (mb_strlen($text) <= $chunkSize) {
            return [$text];
        }

        $chunks = [];
        $paragraphs = preg_split('/\n\s*\n/', $text);
        
        $currentChunk = '';
        
        foreach ($paragraphs as $paragraph) {
            $paragraph = trim($paragraph);
            
            if (empty($paragraph)) {
                continue;
            }
            
            // If adding this paragraph exceeds chunk size
            if (mb_strlen($currentChunk . "\n\n" . $paragraph) > $chunkSize) {
                // Save current chunk if not empty
                if (!empty($currentChunk)) {
                    $chunks[] = trim($currentChunk);
                    $currentChunk = '';
                }
                
                // If paragraph itself is larger than chunk size, split it
                if (mb_strlen($paragraph) > $chunkSize) {
                    $sentences = preg_split('/(?<=[.!?])\s+/', $paragraph);
                    
                    foreach ($sentences as $sentence) {
                        if (mb_strlen($currentChunk . ' ' . $sentence) <= $chunkSize) {
                            $currentChunk .= (empty($currentChunk) ? '' : ' ') . $sentence;
                        } else {
                            if (!empty($currentChunk)) {
                                $chunks[] = trim($currentChunk);
                            }
                            $currentChunk = $sentence;
                        }
                    }
                } else {
                    $currentChunk = $paragraph;
                }
            } else {
                // Add paragraph to current chunk
                $currentChunk .= (empty($currentChunk) ? '' : "\n\n") . $paragraph;
            }
        }
        
        // Add remaining content
        if (!empty($currentChunk)) {
            $chunks[] = trim($currentChunk);
        }
        
        return $chunks;
    }

    private function isSupportedFile(string $extension): bool
    {
        $supported = ['txt', 'md', 'json', 'csv', 'log'];
        return in_array(strtolower($extension), $supported);
    }
}