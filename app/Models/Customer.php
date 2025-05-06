<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    // Tentukan atribut yang dapat diisi
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'address',
        'gender',
    ];

    /**
     * Relasi dengan model User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
