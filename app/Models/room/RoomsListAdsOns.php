<?php

namespace App\Models\room;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomsListAdsOns extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'image',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get all of the rooms for the RoomsListAdsOns
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rooms(): HasMany
    {
        return $this->hasMany(RoomAddonsManyToMany::class, 'addon_id', 'id');
    }

}
