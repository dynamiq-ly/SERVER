<?php

namespace App\Models\room;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'visible',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    /**
     * Get all of the rooms for the RoomCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rooms(): HasMany
    {
        return $this->hasMany(RoomsList::class, 'room_id', 'id');
    }
}
