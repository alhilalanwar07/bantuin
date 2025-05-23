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

    public function getRatingSummaryAttribute()
    {
        $referenceNumbers = $this->serviceRequests()
            ->where('status_id', 6)
            ->pluck('reference_number');

        $ratings = Rating::whereIn('reference_number', $referenceNumbers)
            ->with(['reviewer.user']) // eager load untuk menghindari N+1
            ->get();

        return [
            'average' => round($ratings->avg('score'), 1),
            'total' => $ratings->count(),
            'distribution' => [
                5 => $ratings->where('score', 5)->count(),
                4 => $ratings->where('score', 4)->count(),
                3 => $ratings->where('score', 3)->count(),
                2 => $ratings->where('score', 2)->count(),
                1 => $ratings->where('score', 1)->count(),
            ],
            // 'reviews' => $ratings->sortByDesc('created_at')->values()->map(function ($rating) {
            //     return [
            //         'score' => $rating->score,
            //         'comment' => $rating->review,
            //         'reviewer' => $rating->reviewer->name ?? null,
            //         'customer_photo' => $rating->reviewer->user->profile_photo ?? null,
            //         'date' => $rating->created_at->toDateString(),
            //     ];
            // }),
        ];
    }
}
