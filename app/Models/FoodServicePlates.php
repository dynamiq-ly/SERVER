<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FoodServicePlates extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'plate_name',
        'plate_image',
        'plate_descripiton',
        'plate_price',
        'plate_variance',
        'food_service_categories_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'food_service_categories_id'
    ];

    /**
     * Get all of the supplements for the FoodServicePlates
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function supplements(): HasMany
    {
        return $this->hasMany(FoodServicePlatesSupplements::class, 'food_service_plates_id', 'id');
    }

    /**
     * Get the category that owns the FoodServicePlates
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(FoodServiceCategory::class, 'food_service_categories_id', 'id');
    }
}
