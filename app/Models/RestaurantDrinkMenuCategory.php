<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RestaurantDrinkMenuCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'restaurant_drink_category',
        'restaurant_drink_image',
        'restaurant_drink_type',
        'restaurant_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'restaurant_id'
    ];

    /**
     * Get the restaurant that owns the RestaurantDrinkMenuCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }

    /**
     * Get all of the softdrinks for the RestaurantDrinkMenuCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function softdrinks(): HasMany
    {
        return $this->hasMany(RestaurantDrinkMenuSoft::class, 'restaurant_soft_drink_id', 'id');
    }

    /**
     * Get all of the softdrinks for the RestaurantDrinkMenuCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function alcoholdrinks(): HasMany
    {
        return $this->hasMany(RestaurantDrinkMenuAlchohol::class, 'restaurant_alcohol_id', 'id');
    }
}
