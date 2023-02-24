<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PointInterest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'point_title',
        'point_small_summary',
        'point_description',
        'point_contact_number',
        'point_website_information',
        'point_textual_location',
        'point_cords_location',
        'point_recommended_visit',
        'point_status',
        'images',
        'point_interest_types_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'point_interest_types_id'
    ];

    /**
     * Get the schedule associated with the PointInterest
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function schedule(): HasOne
    {
        return $this->hasOne(PointInterestSchedule::class, 'point_id', 'id');
    }


    /**
     * Get the pointType that owns the PointInterest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pointType(): BelongsTo
    {
        return $this->belongsTo(PointInterestType::class, 'point_interest_types_id', 'id');
    }
}
