<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EntertainementsSportEvents extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'sport_type',
        'sport_event',
        'sport_event_image',
        'sport_event_home_team',
        'sport_event_home_image',
        'sport_event_away_team',
        'sport_event_away_image',
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
