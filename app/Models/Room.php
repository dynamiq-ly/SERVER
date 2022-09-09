<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'room_name',
        'room_floor',
        'room_number',
        'room_descripton',
        'room_space_area',
        'room_features',
        'room_price',
        'room_view',
        'room_occupency_max',
        'room_occupency_max_adult',
        'room_occupency_max_children',
        'room_occupency_max_guest',
        'room_child_crib',
        'room_smoking',
        'room_can_expend',
        'room_status',
        'room_type_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'room_type_id',
    ];

    /**
     * Get all of the images for the Room
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(RoomImage::class, 'room_id', 'id');
    }

    /**
     * Get the romm_category that owns the Room
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function romm_category(): BelongsTo
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }
}
