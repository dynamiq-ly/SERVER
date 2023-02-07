<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EntertainementDayActivities extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'entertainements_id',
        'day_activity_rated'
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
        return $this->belongsTo(Entertainement::class, 'entertainements_id', 'id');
    }
}
