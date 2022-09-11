<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PointInterestImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image',
        'point_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'point_id'
    ];

    /**
     * Get the pointInterest that owns the PointInterestImage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pointInterest(): BelongsTo
    {
        return $this->belongsTo(PointInterest::class, 'point_id');
    }
}
