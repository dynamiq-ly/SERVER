<?php

namespace App\Models\bar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BarsMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'bar_id',
    ];

    protected $hidden = [
        'bar_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the bar that owns the BarsMenu
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bar(): BelongsTo
    {
        return $this->belongsTo(BarsList::class, 'bar_id', 'id');
    }


    /**
     * Get all of the soft for the BarsMenu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function soft(): HasMany
    {
        return $this->hasMany(BarsSoftDrink::class, 'drink_id', 'id');
    }

    /**
     * Get all of the alcoholic for the BarsMenu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function alcoholic(): HasMany
    {
        return $this->hasMany(BarsAlcoholDrink::class, 'drink_id', 'id');
    }
}
