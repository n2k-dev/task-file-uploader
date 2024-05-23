<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PDFUploadTest extends TestCase
{
    public function test_upload_pdf()
    {
        Storage::fake('s3');

        $response = $this->postJson('/api/upload', [
            'file' => UploadedFile::fake()->create('document.pdf', 1000, 'application/pdf'),
        ]);

        $response->assertStatus(200);
        Storage::disk('s3')->assertExists('pdfs/' . basename($response->json('url')));
    }

    public function test_upload_invalid_file()
    {
        $response = $this->postJson('/api/upload', [
            'file' => UploadedFile::fake()->create('document.txt', 1000, 'text/plain'),
        ]);

        $response->assertStatus(422);
    }
}
