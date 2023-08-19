<?php

namespace App\Models\bar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarsAlcoholDrinkFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'value',
        'image',
        'drink_id',
    ];

    protected $hidden = [
        'drink_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the alcohol that owns the BarsAlcoholDrinkFeature
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alcohol(): BelongsTo
    {
        return $this->belongsTo(BarsAlcoholDrink::class, 'drink_id', 'id');
    }

}
