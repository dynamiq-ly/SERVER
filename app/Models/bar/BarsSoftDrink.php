<?php

namespace App\Models\bar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarsSoftDrink extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'price',
        'ingredients',
        'drink_id',
    ];

    protected $hidden = [
        'drink_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the menu that owns the BarsSoftDrink
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu(): BelongsTo
    {
        return $this->belongsTo(BarsMenu::class, 'drink_id', 'id');
    }
}
