<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EntertainementNightShow extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'night_show_web_link',
        'night_show_leader',
        'night_show_assisatant',
        'night_show_video_link',
        'night_show_ticked_price',
        'night_show_audience',
        'night_show_type',
        'entertainements_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'entertainements_id'
    ];


    /**
     * Get the entertainement that owns the EntertainementNightShow
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entertainement(): BelongsTo
    {
        return $this->belongsTo(Entertainement::class, 'entertainements_id',);
    }
}
