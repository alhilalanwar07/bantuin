<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProviderCertification extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider_id',
        'skill_name',
        'certificate_file',
        'issue_year',
        'issuer',
        'is_verified'
    ];

    protected $casts = [
        'issue_year' => 'integer',
        'is_verified' => 'boolean'
    ];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(ServiceProvider::class, 'provider_id');
    }

    public function specialization(): BelongsTo
    {
        return $this->belongsTo(Specialization::class);
    }
}
