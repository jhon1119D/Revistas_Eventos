<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileManager
{
    protected string $disk;

    public function __construct(string $disk = 'public')
    {
        $this->disk = $disk;
    }

    public function upload(UploadedFile $file, string $folder, ?string $filename = null): string
    {
        $filename = $filename ?: time() . '_' . $file->getClientOriginalName();
        return $file->storeAs($folder, $filename, $this->disk);
    }

    public function delete(?string $path): bool
    {
        if ($path && Storage::disk($this->disk)->exists($path)) {
            return Storage::disk($this->disk)->delete($path);
        }
        return false;
    }
}
