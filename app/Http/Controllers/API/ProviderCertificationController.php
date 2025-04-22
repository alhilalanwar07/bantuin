<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ProviderCertification;
use App\Http\Resources\ProviderCertificationResource;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

class ProviderCertificationController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    public function index(Request $request)
    {
        $certifications = ProviderCertification::where('provider_id', $request->provider_id)
            ->with(['specialization'])
            ->paginate(10);
        
        return ProviderCertificationResource::collection($certifications);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'provider_id' => 'required|exists:service_providers,id',
            'skill_name' => 'required|string|max:100',
            'certificate_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'issue_year' => 'required|integer|min:1900|max:' . date('Y'),
            'issuer' => 'required|string|max:100',
            'specialization_id' => 'required|exists:specializations,id'
        ]);

        if ($request->hasFile('certificate_file')) {
            $result = $this->fileUploadService->uploadServicePhoto(
                $request->file('certificate_file'), 
                'certifications'
            );
            if ($result['success']) {
                $validated['certificate_file'] = $result['path'];
            }
        }

        $certification = ProviderCertification::create($validated);
        return new ProviderCertificationResource($certification);
    }

    public function update(Request $request, ProviderCertification $certification)
    {
        $validated = $request->validate([
            'skill_name' => 'sometimes|string|max:100',
            'certificate_file' => 'sometimes|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'issue_year' => 'sometimes|integer|min:1900|max:' . date('Y'),
            'issuer' => 'sometimes|string|max:100',
            'is_verified' => 'sometimes|boolean',
            'specialization_id' => 'sometimes|exists:specializations,id'
        ]);

        if ($request->hasFile('certificate_file')) {
            $result = $this->fileUploadService->uploadServicePhoto(
                $request->file('certificate_file'), 
                'certifications'
            );
            if ($result['success']) {
                $validated['certificate_file'] = $result['path'];
            }
        }

        $certification->update($validated);
        return new ProviderCertificationResource($certification);
    }

    public function destroy(ProviderCertification $certification)
    {
        if ($certification->certificate_file) {
            $this->fileUploadService->deleteFile($certification->certificate_file);
        }
        
        $certification->delete();
        return response()->noContent();
    }
}