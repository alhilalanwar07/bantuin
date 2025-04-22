<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceRequestResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'reference_number' => $this->reference_number,
            'provider' => new ServiceProviderResource($this->whenLoaded('provider')),
            'specialization' => new SpecializationResource($this->whenLoaded('specialization')),
            'service_address' => $this->service_address,
            'location' => [
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
            ],
            'scheduled_at' => $this->scheduled_at,
            'budget_amount' => $this->budget_amount,
            'agreed_amount' => $this->agreed_amount,
            'status' => $this->whenLoaded('status'),
            'description' => $this->description,
            'cancellation_reason' => $this->cancellation_reason,
            'payment_details' => [
                'status' => $this->payment_status,
                'method' => $this->payment_method,
                'paid_at' => $this->paid_at,
                'proof' => $this->payment_proof,
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
