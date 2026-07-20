<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Screen\AsSource;

class CollectionRequest extends Model
{
    use AsSource, HasFactory;

    public const STATUS_PENDING = 'pending';

    public const STATUS_ACCEPTED = 'accepted';

    public const STATUS_COMPLETED = 'completed';

    public const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'waste_record_id',
        'resident_id',
        'partner_id',
        'collection_point_id',
        'requested_date',
        'scheduled_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'requested_date' => 'date',
        'scheduled_date' => 'date',
    ];

    public function wasteRecord(): BelongsTo
    {
        return $this->belongsTo(WasteRecord::class);
    }

    public function resident(): BelongsTo
    {
        return $this->belongsTo(User::class, 'resident_id');
    }

    public function partner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'partner_id');
    }

    public function collectionPoint(): BelongsTo
    {
        return $this->belongsTo(CollectionPoint::class);
    }
}
