<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CollectionPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'neighborhood',
        'city',
        'state',
        'latitude',
        'longitude',
        'opening_hours',
        'phone',
        'active',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'active' => 'boolean',
    ];

    public function collectionRequests(): HasMany
    {
        return $this->hasMany(CollectionRequest::class);
    }
}
