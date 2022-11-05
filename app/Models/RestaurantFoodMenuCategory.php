<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RestaurantFoodMenuCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'restaurant_food_category',
        'restaurant_food_image',
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
     * Get the restaurants that owns the RestaurantMenu
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }

    /**
     * Get all of the dishes for the RestaurantFoodMenuCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dishes(): HasMany
    {
        return $this->hasMany(RestaurantFoodMenuList::class, 'restaurant_food_categories_id', 'id');
    }
}
