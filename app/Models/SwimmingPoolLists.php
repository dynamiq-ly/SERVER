<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SwimmingPoolLists extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pool_name',
        'pool_image',
        'pool_capacity',
        'pool_description',
        'pool_status',
        'pool_id'
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
     * Get the poolType that owns the SwimmingPoolLists
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function poolType(): BelongsTo
    {
        return $this->belongsTo(SwimmingPool::class, 'pool_id');
    }
}
