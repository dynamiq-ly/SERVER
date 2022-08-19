<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarMenu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bar_menu_category',
        'bar_menu_category_image',
        'bar_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'bar_id'
    ];

    /**
     * Get the bar that owns the BarMenu
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bar(): BelongsTo
    {
        return $this->belongsTo(Bar::class, 'bar_id');
    }
}
