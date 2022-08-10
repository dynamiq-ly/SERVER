<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SwimmingPool extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pool_type',
        'pool_image',
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
     * Get all of the comments for the SwimmingPool
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pools(): HasMany
    {
        return $this->hasMany(SwimmingPoolLists::class, 'pool_id', 'id');
    }
}
