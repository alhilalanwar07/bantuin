<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Specialization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_active',
        'icon'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function providerCertifications()
    {
        return $this->hasMany(ProviderCertification::class);
    }
}
