<?php

namespace App\Models\point;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PointOfInterestSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'point_id',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday'
    ];

    protected $hidden = [
        'id',
        'point_id',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the point that owns the PointOfInterestSchedule
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function point(): BelongsTo
    {
        return $this->belongsTo(PointOfInterest::class, 'point_id', 'id');
    }

}
