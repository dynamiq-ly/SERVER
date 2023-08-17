<?php

namespace App\Models\room;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomsListImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'room_id',
    ];


    protected $hidden = [
        'room_id',
        'created_at',
        'updated_at',
    ];


    /**
     * Get the room that owns the RoomsListImage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(RoomsListImage::class, 'room_id', 'id');
    }
}
