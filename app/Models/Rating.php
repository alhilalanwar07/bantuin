<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_number',
        'score',
        'review',
        'reviewer_id',
        'status'
    ];

    protected $casts = [
        'score' => 'integer'
    ];

    public function serviceRequest(): BelongsTo
    {
        return $this->belongsTo(ServiceRequest::class, 'reference_number', 'reference_number');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'reviewer_id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(ServiceProvider::class, 'provider_id');
    }

}
