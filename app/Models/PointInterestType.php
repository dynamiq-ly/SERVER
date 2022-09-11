<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PointInterestType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'point_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * Get all of the points for the PointInterestType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function interestPoints(): HasMany
    {
        return $this->hasMany(Comment::class, 'point_interest_types_id', 'id');
    }
}
