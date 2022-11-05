<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RestaurantFoodMenuList extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'dish_name',
        'dish_image',
        'dish_price',
        'dish_summary',
        'dish_discount',
        'dish_wait_time',
        'dish_ingredient',
        'dish_description',
        'restaurant_food_categories_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'restaurant_food_categories_id'
    ];

    /**
     * Get the foodMenu that owns the RestaurantFoodMenuList
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function foodMenu(): BelongsTo
    {
        return $this->belongsTo(RestaurantFoodMenuCategory::class, 'restaurant_food_categories_id');
    }
}
