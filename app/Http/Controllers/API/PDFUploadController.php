<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadPDFRequest;
use App\Services\PDFUploadService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class PDFUploadController extends Controller
{
    protected PDFUploadService $pdfUploadService;

    public function __construct(PDFUploadService $pdfUploadService)
    {
        $this->pdfUploadService = $pdfUploadService;
    }

    public function upload(UploadPDFRequest $request): JsonResponse
    {
        try {
            $fileUrl = $this->pdfUploadService->upload($request->file('file'));
            return response()->json(['url' => $fileUrl]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'File upload failed'], 500);
        }
    }
}
