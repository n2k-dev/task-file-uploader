<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;

class PDFUploadService
{
    public function upload($file): string
    {
        $filePath = 'pdfs/' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = Storage::disk('s3')->put($filePath, file_get_contents($file));
        return Storage::disk('s3')->url($filePath);
    }
}
