<?php

namespace App\Models\point;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PointOfInterest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'coordinates',
        'phone',
        'website',
        'description',
        'visible',
        'point_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get the category that owns the PointOfInterest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(PointOfInterestCategory::class, 'point_id', 'id');
    }

    /**
     * Get all of the images for the PointOfInterest
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(PointOfInterestImage::class, 'point_id', 'id');
    }

    /**
     * Get the schedule associated with the PointOfInterest
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function schedule(): HasOne
    {
        return $this->hasOne(PointOfInterestSchedule::class, 'point_id', 'id');
    }

}
