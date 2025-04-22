<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisementResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'advertiser' => new AdvertiserResource($this->whenLoaded('advertiser')),
            'banner_image' => asset('storage/' . $this->banner_image),
            'duration_days' => $this->duration_days,
            'category' => $this->category,
            'status' => $this->status,
            'payment_status' => $this->payment_status,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
