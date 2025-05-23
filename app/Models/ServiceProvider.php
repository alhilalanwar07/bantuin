<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'gender',
        'latitude',
        'longitude',
        'is_available',
        'account_balance',
        'specialization_id',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    public function certifications(): HasMany
    {
        return $this->hasMany(ProviderCertification::class, 'provider_id');
    }

    public function serviceRequests(): HasMany
    {
        return $this->hasMany(ServiceRequest::class, 'provider_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class, 'provider_id');
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id');
    }

    public function getTotalRatingScoreAttribute()
    {
        return $this->serviceRequests()
            ->with('rating')
            ->get()
            ->pluck('rating')
            ->flatten()
            ->sum('score');
    }
}
