<?php

namespace App\Models\room;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RoomsList extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'description',
        'virtual',
        'room_floor',
        'room_number',
        'room_id',
    ];

    protected $hidden = [
        'room_id',
        'created_at',
        'updated_at',
    ];


    /**
     * Get the category that owns the RoomsList
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(RoomCategory::class, 'room_id', 'id');
    }

    /**
     * Get all of the images for the RoomsListImage
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(RoomsListImage::class, 'room_id', 'id');
    }

    /**
     * Get the config associated with the RoomsListImage
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function config(): HasOne
    {
        return $this->hasOne(RoomsListConfig::class, 'room_id', 'id');
    }

    /**
     * Get all of the features for the RoomsList
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function features(): HasMany
    {
        return $this->hasMany(RoomsListFeatures::class, 'room_id', 'id');
    }

    /**
     * Get all of the addons for the RoomsList
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addons(): HasMany
    {
        return $this->hasMany(RoomAddonsManyToMany::class, 'room_id', 'id');
    }

}
