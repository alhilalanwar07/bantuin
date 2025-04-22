<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceProviderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'gender' => $this->gender,
            'location' => [
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
            ],
            'is_available' => $this->is_available,
            'specializations' => SpecializationResource::collection($this->whenLoaded('specializations')),
            'certifications' => ProviderCertificationResource::collection($this->whenLoaded('certifications')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
