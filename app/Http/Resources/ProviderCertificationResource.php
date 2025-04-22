<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProviderCertificationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'provider_id' => $this->provider_id,
            'skill_name' => $this->skill_name,
            'certificate_file' => $this->certificate_file ? asset('storage/' . $this->certificate_file) : null,
            'issue_year' => $this->issue_year,
            'issuer' => $this->issuer,
            'is_verified' => $this->is_verified,
            'specialization' => new SpecializationResource($this->whenLoaded('specialization')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}