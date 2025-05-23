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

    public function serviceproviders()
    {
        return $this->hasMany(ServiceProvider::class);
    }

    public function countServiceproviders()
{
    return $this->hasManyThrough(
        ServiceProvider::class,
        ProviderCertification::class,
        'specialization_id',       // Foreign key di ProviderCertification
        'id',                      // Foreign key di ServiceProvider
        'id',                      // Local key di Specialization
        'service_provider_id'      // Local key di ProviderCertification
    )->distinct(); // Penting jika ingin count unik
}
}
