<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServicePhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_number',
        'image_1',
        'image_2',
        'image_3',
        'image_4'
    ];

    public function serviceRequest(): BelongsTo
    {
        return $this->belongsTo(ServiceRequest::class, 'reference_number', 'reference_number');
    }
}
