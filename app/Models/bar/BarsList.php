<?php

namespace App\Models\bar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BarsList extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'location',
        'phone_number',
        'description',
        'timing_open',
        'timing_close',
        'reservation_required',
        'adults_only',
        'menu_a_la_carte',
        'visible',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get all of the images for the BarsList
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(BarsImage::class, 'bar_id', 'id');
    }

    /**
     * Get all of the staff for the BarsList
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function staff(): HasMany
    {
        return $this->hasMany(BarsStaff::class, 'bar_id', 'id');
    }

    /**
     * Get all of the menu for the BarsList
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menu(): HasMany
    {
        return $this->hasMany(BarsMenu::class, 'bar_id', 'id');
    }
}
