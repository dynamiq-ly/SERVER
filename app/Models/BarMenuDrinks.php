<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarMenuDrinks extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bar_drink_name',
        'bar_drink_image',
        'bar_drink_price',
        'drink_bar_strengh',
        'drink_served_one',
        'bar_drink_served',
        'drink_main_alcohol',
        'bar_drink_preperation',
        'bar_drink_ingredient',
        'menu_drink_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'menu_drink_id'
    ];

    /**
     * Get the bar that owns the BarMenu
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bar(): BelongsTo
    {
        return $this->belongsTo(BarMenu::class, 'menu_drink_id', 'id');
    }
}
