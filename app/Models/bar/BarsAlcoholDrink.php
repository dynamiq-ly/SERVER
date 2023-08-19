<?php

namespace App\Models\bar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BarsAlcoholDrink extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'slug',
        'size',
        'price',
        'small_price',
        'category',
        'type',
        'served_slug',
        'served_with',
        'preperation',
        'description',
        'drink_id',
    ];

    protected $hidden = [
        'drink_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the menu that owns the BarsAlcoholDrink
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu(): BelongsTo
    {
        return $this->belongsTo(BarsMenu::class, 'drink_id', 'id');
    }

    /**
     * Get all of the features for the BarsAlcoholDrink
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function features(): HasMany
    {
        return $this->hasMany(BarsAlcoholDrinkFeature::class, 'drink_id', 'id');
    }
}
