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
        'restaurant_description',
        'restaurant_email',
        'restaurant_phone',
        'restaurant_website',
        'restaurant_location',
        'restaurant_position',
        'isVisible'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

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
     * Get all of the servings for the Restaurant
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function servings(): HasMany
    {
        return $this->hasMany(RestaurantServings::class, 'restaurant_id', 'id');
    }

    /**
     * Get the booking associated with the Restaurant
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function booking(): HasOne
    {
        return $this->hasOne(RestaurantBooking::class, 'restaurant_id', 'id');
    }

    /**
     * Get all of the chefs for the Restaurant
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chefs(): HasMany
    {
        return $this->hasMany(RestaurantChef::class, 'restaurant_id', 'id');
    }

    /**
     * Get all of the specialities for the Restaurant
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function specialities(): HasMany
    {
        return $this->hasMany(RestaurantSpeciality::class, 'restaurant_id', 'id');
    }

    /**
     * Get all of the foodMenu for the Restaurant
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function foodCatalog(): HasMany
    {
        return $this->hasMany(RestaurantFoodMenu::class, 'restaurant_id', 'id');
    }

    /**
     * Get all of the drinkCatalog for the Restaurant
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function drinkCatalog(): HasMany
    {
        return $this->hasMany(RestaurantDrinkMenu::class, 'restaurant_id', 'id');
    }

    /**
     * Get the schedule associated with the Restaurant
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function schedule(): HasOne
    {
        return $this->hasOne(RestaurantWeeklySchedule::class, 'restaurant_id', 'id');
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
