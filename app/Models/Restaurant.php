<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Restaurant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'restaurant_name',
        'restaurant_website',
        'restaurant_descripton',
        'restaurant_opens',
        'restaurant_closes',
        'restaurant_location',
        'restaurant_speciality',
        'restaurant_status',
        'restaurant_capacity',
        'restaurant_can_book',
        'restaurant_booked_capacity'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * Get all of the images for the Restaurant
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(RestaurantImage::class, 'restaurant_id', 'id');
    }

    /**
     * Get the chefs associated with the Restaurant
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function chefs(): HasOne
    {
        return $this->hasOne(RestaurantChef::class, 'restaurant_id', 'id');
    }

    /**
     * Get all of the regulations for the Restaurant
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function regulations(): HasMany
    {
        return $this->hasMany(RestaurantRegulation::class, 'restaurant_id', 'id');
    }
}
