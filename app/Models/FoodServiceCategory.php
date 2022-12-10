<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FoodServiceCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'food_service_name',
        'food_service_opens',
        'food_service_closes',
        'food_service_min_order',
        'food_service_description',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get all of the plates for the FoodServiceCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function plates(): HasMany
    {
        return $this->hasMany(FoodServicePlates::class, 'food_service_categories_id', 'id');
    }
}
