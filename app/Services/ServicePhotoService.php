<?php

namespace App\Services;

use App\Models\ServicePhoto;
use App\Models\ServiceProgressPhoto;
use Illuminate\Support\Facades\DB;

class ServicePhotoService extends BaseService
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    public function uploadServicePhotos($request, $referenceNumber)
    {
        try {
            DB::beginTransaction();

            $photos = [];
            foreach (['image_1', 'image_2', 'image_3', 'image_4'] as $key) {
                if ($request->hasFile($key)) {
                    $result = $this->fileUploadService->uploadServicePhoto($request->file($key));
                    if ($result['success']) {
                        $photos[$key] = $result['path'];
                    }
                }
            }

            if (!empty($photos)) {
                ServicePhoto::updateOrCreate(
                    ['reference_number' => $referenceNumber],
                    $photos
                );
            }

            DB::commit();
            return $this->success($photos, 'Photos uploaded successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage());
        }
    }

    public function uploadProgressPhotos($request, $referenceNumber)
    {
        try {
            DB::beginTransaction();

            $photos = [];
            if ($request->hasFile('before_photo')) {
                $result = $this->fileUploadService->uploadServicePhoto($request->file('before_photo'), 'progress-photos');
                if ($result['success']) {
                    $photos['before_photo'] = $result['path'];
                }
            }

            if ($request->hasFile('after_photo')) {
                $result = $this->fileUploadService->uploadServicePhoto($request->file('after_photo'), 'progress-photos');
                if ($result['success']) {
                    $photos['after_photo'] = $result['path'];
                }
            }

            if (!empty($photos)) {
                ServiceProgressPhoto::updateOrCreate(
                    ['reference_number' => $referenceNumber],
                    $photos
                );
            }

            DB::commit();
            return $this->success($photos, 'Progress photos uploaded successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage());
        }
    }
}