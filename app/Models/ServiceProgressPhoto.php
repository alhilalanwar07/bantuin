<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceProgressPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_number',
        'before_photo',
        'after_photo'
    ];

    public function serviceRequest(): BelongsTo
    {
        return $this->belongsTo(ServiceRequest::class, 'reference_number', 'reference_number');
    }
}
