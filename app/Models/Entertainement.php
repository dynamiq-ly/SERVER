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
        'entertainement_name',
        'entertainement_summary',
        'entertainement_description',
        'entertainement_type',
        'entertainement_age',
        'entertainement_location',
        'entertainement_duration',
        'entertainement_joinable',
        'isVisible',
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
     * Get the shows associated with the Entertainement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function show(): HasOne
    {
        return $this->hasOne(EntertainementsNightShows::class, 'entertainement_id', 'id');
    }

    /**
     * Get the sport associated with the Entertainement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sport(): HasOne
    {
        return $this->hasOne(EntertainementsSportEvents::class, 'entertainement_id', 'id');
    }

    /**
     * Get all of the images for the Entertainement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(EntertainementImage::class, 'entertainement_id', 'id');
    }

    /**
     * Get all of the timings for the Entertainement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function timings(): HasMany
    {
        return $this->hasMany(EntertainementTiming::class, 'entertainement_id', 'id');
    }
}
