<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_number',
        'provider_id',
        'specialization_id',
        'service_address',
        'longitude',
        'latitude',
        'scheduled_at',
        'budget_amount',
        'agreed_amount',
        'status_id',
        'description',
        'cancellation_reason',
        'payment_status',
        'payment_method',
        'payment_proof',
        'paid_at'
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'paid_at' => 'datetime',
        'longitude' => 'decimal:7',
        'latitude' => 'decimal:7',
        'budget_amount' => 'decimal:2',
        'agreed_amount' => 'decimal:2'
    ];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(ServiceProvider::class, 'provider_id');
    }

    public function specialization(): BelongsTo
    {
        return $this->belongsTo(Specialization::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(ServiceStatus::class, 'status_id');
    }

    public function photos(): HasOne
    {
        return $this->hasOne(ServicePhoto::class, 'reference_number', 'reference_number');
    }

    public function progressPhotos(): HasOne
    {
        return $this->hasOne(ServiceProgressPhoto::class, 'reference_number', 'reference_number');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'reference_number', 'reference_number');
    }

    public function rating(): HasOne
    {
        return $this->hasOne(Rating::class, 'reference_number', 'reference_number');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status_id', 4);
    }

    public function scopePending($query)
    {
        return $query->whereIn('status_id', [1, 2, 3]);
    }

    public function scopeWhereDateBetween($query, $column, $start, $end, $period = 'day')
    {
        return $query->whereBetween($column, [
            $start->startOf($period),
            $end->endOf($period)
        ]);
    }
}
