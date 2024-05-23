<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PDFUploadController;

Route::post('/upload', [PDFUploadController::class, 'upload']);
