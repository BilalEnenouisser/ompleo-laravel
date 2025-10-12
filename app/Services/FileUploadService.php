<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadService
{
    /**
     * Upload a resume file
     */
    public function uploadResume(UploadedFile $file): string
    {
        $this->validateFile($file, ['pdf', 'doc', 'docx'], 5120); // 5MB max
        
        $filename = $this->generateUniqueFilename($file, 'resumes');
        $path = $file->storeAs('resumes', $filename, 'public');
        
        return $path;
    }

    /**
     * Upload an avatar file
     */
    public function uploadAvatar(UploadedFile $file): string
    {
        $this->validateFile($file, ['jpg', 'jpeg', 'png'], 2048); // 2MB max
        
        $filename = $this->generateUniqueFilename($file, 'avatars');
        $path = $file->storeAs('avatars', $filename, 'public');
        
        return $path;
    }

    /**
     * Upload a company logo
     */
    public function uploadLogo(UploadedFile $file): string
    {
        $this->validateFile($file, ['jpg', 'jpeg', 'png'], 2048); // 2MB max
        
        $filename = $this->generateUniqueFilename($file, 'logos');
        $path = $file->storeAs('logos', $filename, 'public');
        
        return $path;
    }

    /**
     * Delete a file
     */
    public function deleteFile(string $path): bool
    {
        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }
        
        return false;
    }

    /**
     * Generate unique filename
     */
    public function generateUniqueFilename(UploadedFile $file, string $prefix = ''): string
    {
        $extension = $file->getClientOriginalExtension();
        $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $uniqueId = Str::random(10);
        
        return $prefix ? "{$prefix}_{$filename}_{$uniqueId}.{$extension}" : "{$filename}_{$uniqueId}.{$extension}";
    }

    /**
     * Validate file type and size
     */
    private function validateFile(UploadedFile $file, array $allowedTypes, int $maxSizeKB): void
    {
        $extension = strtolower($file->getClientOriginalExtension());
        
        if (!in_array($extension, $allowedTypes)) {
            throw new \InvalidArgumentException("File type not allowed. Allowed types: " . implode(', ', $allowedTypes));
        }
        
        if ($file->getSize() > $maxSizeKB * 1024) {
            throw new \InvalidArgumentException("File too large. Maximum size: {$maxSizeKB}KB");
        }
    }

    /**
     * Get file URL
     */
    public function getFileUrl(string $path): string
    {
        return Storage::disk('public')->url($path);
    }

    /**
     * Check if file exists
     */
    public function fileExists(string $path): bool
    {
        return Storage::disk('public')->exists($path);
    }
}
