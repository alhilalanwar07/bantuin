<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Advertiser extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'contact_phone',
        'contact_email',
        'business_address'
    ];

    public function advertisements(): HasMany
    {
        return $this->hasMany(Advertisement::class);
    }
}
