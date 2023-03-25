<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FoodServicePlatesSupplements extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'supplement_name',
        'supplement_price',
        'food_service_plates_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'food_service_plates_id'
    ];

    /**
     * Get the plate that owns the FoodServicePlatesSupplements
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plate(): BelongsTo
    {
        return $this->belongsTo(FoodServicePlates::class, 'food_service_plates_id', 'id');
    }
}
