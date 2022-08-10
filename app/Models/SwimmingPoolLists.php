<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SwimmingPoolLists extends Model
{
    use HasFactory;

    /**
     * Get the poolType that owns the SwimmingPoolLists
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function poolType(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pool_id');
    }
}
