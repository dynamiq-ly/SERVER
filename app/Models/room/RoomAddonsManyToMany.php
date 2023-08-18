<?php

namespace App\Models\room;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class RoomAddonsManyToMany extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'addon_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get the room that owns the RoomAddonsManyToMany
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(RoomsList::class, 'room_id', 'id');
    }

    /**
     * Get the addon that owns the RoomAddonsManyToMany
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function addon(): BelongsTo
    {
        return $this->belongsTo(RoomsListAdsOns::class, 'addon_id', 'id');
    }
}
