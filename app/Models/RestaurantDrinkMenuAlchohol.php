<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RestaurantDrinkMenuAlchohol extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'drink_alcohol_name',
        'drink_alcohol_type',
        'drink_alcohol_bottle_size',
        'drink_alcohol_bottle_price',
        'drink_alcohol_glass_size',
        'drink_alcohol_glass_price',
        'drink_alcohol_description',
        'drink_alcohol_origin',
        'drink_alcohol_year',
        'drink_alcohol_ingredient',
        'drink_alcohol_percentage',
        'drink_alcohol_image',
        'restaurant_alcohol_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'restaurant_alcohol_id'
    ];

    /**
     * Get the restaurant that owns the RestaurantDrinkMenuCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(RestaurantDrinkMenuCategory::class, 'restaurant_alcohol_drink_id');
    }
}
