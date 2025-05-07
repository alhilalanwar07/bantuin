<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceBid extends Model
{
    protected $fillable = [
        'reference_number',
        'provider_id',
        'bid_amount',
        'status_id',
    ];

    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class);
    }

    public function provider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }

    public function status()
    {
        return $this->belongsTo(ServiceStatus::class);
    }
}
