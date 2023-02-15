<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TourAgencyGuide extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'guide_name',
        'guide_about',
        'guide_phone',
        'guide_email',
        'guide_link',
        'guide_instagram',
        'guide_lang_spoken',
        'guide_image',
        'agencies_id',
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
     * Get the agency that owns the TourAgencyGuide
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agency(): BelongsTo
    {
        return $this->belongsTo(TourAgency::class, 'agencies_id', 'id');
    }

    /**
     * Get the timing associated with the TourAgencyGuide
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function timing(): HasOne
    {
        return $this->hasOne(TourAgencyGuideTiming::class, 'guide_id', 'id');
    }
}
