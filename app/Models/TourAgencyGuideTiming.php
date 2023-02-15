<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourAgencyGuideTiming extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sunday',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'guide_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'guide_id'
    ];

    /**
     * Get the agency that owns the TourAgencyGuide
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function guide(): BelongsTo
    {
        return $this->belongsTo(TourAgencyGuide::class, 'guide_id', 'id');
    }
}
