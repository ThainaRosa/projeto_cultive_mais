<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Screen\AsSource;

class WasteRecord extends Model
{
    use AsSource, HasFactory;

    public const STATUS_AVAILABLE = 'available';

    public const STATUS_REQUESTED = 'requested';

    public const STATUS_COLLECTED = 'collected';

    public const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'user_id',
        'waste_category_id',
        'description',
        'quantity',
        'unit',
        'status',
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function wasteCategory(): BelongsTo
    {
        return $this->belongsTo(WasteCategory::class);
    }

    public function collectionRequests(): HasMany
    {
        return $this->hasMany(CollectionRequest::class);
    }
}
