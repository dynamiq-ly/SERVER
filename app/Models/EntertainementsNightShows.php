<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EntertainementsNightShows extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'night_show_price',
        'night_show_tickets',
        'night_show_link',
        'night_show_video',
        'night_show_genre',
        'night_show_performers',
        'entertainement_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'entertainement_id'
    ];

    /**
     * Get the entertainement that owns the EntertainementsNightShows
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entertainement(): BelongsTo
    {
        return $this->belongsTo(Entertainement::class, 'entertainement_id', 'id');
    }
}
