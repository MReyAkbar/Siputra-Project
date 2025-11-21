<?php

namespace App\Console\Commands;

use App\Services\RagService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class IndexDocumentsCommand extends Command
{
    protected $signature = 'rag:index 
                            {path : Path to directory or file to index}
                            {--chunk-size=1000 : Maximum characters per chunk}
                            {--overlap=200 : Overlap between chunks}';

    protected $description = 'Index documents for RAG chatbot';

    protected RagService $ragService;

    public function __construct(RagService $ragService)
    {
        parent::__construct();
        $this->ragService = $ragService;
    }

    public function handle()
    {
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
        $chunks = $this->splitIntoChunks($content, $chunkSize, $overlap);

        foreach ($chunks as $index => $chunk) {
            $metadata = [
                'filename' => $filename,
                'chunk_index' => $index,
                'total_chunks' => count($chunks),
                'file_path' => $filePath,
            ];

            $success = $this->ragService->addDocument($chunk, $metadata);

            if (!$success) {
                $this->error("Failed to index chunk {$index} of {$filename}");
            }
        }

        if ($showProgress) {
            $this->info("✓ Indexed {$filename} into " . count($chunks) . " chunks");
        }
    }

    private function splitIntoChunks(string $text, int $chunkSize, int $overlap): array
    {
        $text = trim($text);
        $length = strlen($text);
        
        if ($length <= $chunkSize) {
            return [$text];
        }

        $chunks = [];
        $start = 0;

        while ($start < $length) {
            $end = min($start + $chunkSize, $length);
            
            // Try to break at sentence or word boundary
            if ($end < $length) {
                // Look for sentence end
                $sentenceEnd = strrpos(substr($text, $start, $chunkSize), '.');
                if ($sentenceEnd !== false && $sentenceEnd > $chunkSize * 0.5) {
                    $end = $start + $sentenceEnd + 1;
                } else {
                    // Look for word boundary
                    $wordEnd = strrpos(substr($text, $start, $chunkSize), ' ');
                    if ($wordEnd !== false && $wordEnd > $chunkSize * 0.5) {
                        $end = $start + $wordEnd;
                    }
                }
            }

            $chunk = substr($text, $start, $end - $start);
            $chunks[] = trim($chunk);

            $start = $end - $overlap;
            if ($start < 0) $start = $end;
        }

        return $chunks;
    }

    private function isSupportedFile(string $extension): bool
    {
        $supported = ['txt', 'md', 'json', 'csv', 'log', 'php', 'html', 'xml'];
        return in_array(strtolower($extension), $supported);
    }
}