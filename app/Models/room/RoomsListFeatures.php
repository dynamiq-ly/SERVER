<?php

namespace App\Models\room;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomsListFeatures extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'description',
        'keys',
        'room_id',
    ];

    protected $hidden = [
        'room_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the room that owns the RoomsListFeatures
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(RoomsList::class, 'room_id', 'id');
    }
}
