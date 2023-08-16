<?php

namespace App\Models\point;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PointOfInterestImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'point_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'point_id'
    ];

    /**
     * Get the point that owns the PointOfInterestImage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function point(): BelongsTo
    {
        return $this->belongsTo(PointOfInterest::class, 'point_id', 'id');
    }

}
