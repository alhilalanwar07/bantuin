<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecordTopup extends Model
{
    protected $fillable = [
        'provider_id',
        'amount',
        'snap_token',
        'topup_method',
        'status',
        'paid_at',
    ];

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class, 'provider_id');
    }
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'pending' => 'Pending',
            'success' => 'Success',
            'failed' => 'Failed',
            default => 'Unknown',
        };
    }
    public function getFormattedAmountAttribute()
    {
        return number_format($this->amount, 0, ',', '.');
    }
    public function getFormattedPaidAtAttribute()
    {
        return $this->paid_at ? $this->paid_at->format('d-m-Y H:i:s') : 'Not Paid';
    }
    public function getTopupMethodLabelAttribute()
    {
        return $this->topup_method ? ucfirst($this->topup_method) : 'N/A';
    }
    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at->format('d-m-Y H:i:s');
    }
}
