<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'reference_number' => $this->reference_number,
            'score' => $this->score,
            'review' => $this->review,
            'reviewer_id' => $this->reviewer_id,
            'service_request' => new ServiceRequestResource($this->whenLoaded('serviceRequest')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
