<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image',
        'room_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'room_id',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the room that owns the RoomImages
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rooms(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
