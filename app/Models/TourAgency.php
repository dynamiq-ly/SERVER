<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TourAgency extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'agency_title',
        'agency_summary',
        'agency_description',
        'agency_website',
        'agency_image'
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
     * Get all of the services for the TourAgency
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services(): HasMany
    {
        return $this->hasMany(TourAgencyService::class, 'agencies_id', 'id');
    }


    /**
     * Get all of the guides for the TourAgency
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function guides(): HasMany
    {
        return $this->hasMany(TourAgencyGuide::class, 'agencies_id', 'id');
    }
}
