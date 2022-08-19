<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bar extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bar_name',
        'bar_location',
        'bar_open_time',
        'bar_description',
        'bar_closed_days',
        'bar_phone_number',
        'bar_status',
        'bar_can_book',
        'bar_booking_capacity',
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
     * Get all of the images for the Bar
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(BarImage::class, 'bar_id', 'id');
    }
}
