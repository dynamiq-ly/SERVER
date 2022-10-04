<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Entertainement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'entertainements_title',
        'entertainements_type',
        'entertainements_summary',
        'entertainements_description',
        'entertainements_location',
        'entertainements_duration',
        'entertainements_location_can_join',
        'entertainements_status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get all of the timings for the Entertainement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function timings(): HasMany
    {
        return $this->hasMany(EntertainementTiming::class, 'entertainements_id', 'id');
    }

    /**
     * Get all of the images for the Entertainement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(EntertainementImage::class, 'entertainements_id', 'id');
    }

    /**
     * Get all of the nightShows for the Entertainement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function nightShows(): HasOne
    {
        return $this->hasOne(EntertainementNightShow::class, 'entertainements_id', 'id');
    }
}
