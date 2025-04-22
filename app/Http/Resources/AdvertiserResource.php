<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvertiserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'company_name' => $this->company_name,
            'contact_phone' => $this->contact_phone,
            'contact_email' => $this->contact_email,
            'business_address' => $this->business_address,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}