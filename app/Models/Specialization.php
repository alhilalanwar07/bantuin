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

    // public function serviceproviders()
    // {
    //     return $this->hasMany(ServiceProvider::class);
    // }

    public function serviceProviders()
    {
        return $this->hasManyThrough(
            ServiceProvider::class,
            ProviderCertification::class,
            'specialization_id', // foreign key di ProviderCertification
            'id', // foreign key di ServiceProvider
            'id', // local key di Specialization
            'service_provider_id' // local key di ProviderCertification
        )->distinct(); // jika kamu ingin hanya count unik
    }
}
