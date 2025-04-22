<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadService extends BaseService
{
    public function uploadServicePhoto($file, $folder = 'service-photos')
    {
        try {
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = Storage::disk('public')->putFileAs($folder, $file, $fileName);
            
            return [
                'success' => true,
                'path' => $path,
                'url' => Storage::disk('public')->url($path)
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function uploadMultiplePhotos($files, $folder = 'service-photos')
    {
        $uploadedFiles = [];
        
        foreach ($files as $file) {
            $result = $this->uploadServicePhoto($file, $folder);
            if ($result['success']) {
                $uploadedFiles[] = $result;
            }
        }

        return $uploadedFiles;
    }

    public function deleteFile($path)
    {
        try {
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }
}