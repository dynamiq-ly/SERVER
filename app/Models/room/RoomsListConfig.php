<?php

namespace App\Models\room;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomsListConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'visible',
        'booking',
        'upgrade-price',
        'downgrade-price',
        'upgrade-description',
        'room_id',
    ];

    protected $hidden = [
        'id',
        'room_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the room that owns the RoomsListConfig
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(RoomsList::class, 'room_id', 'id');
    }
}
