<?php

namespace App\Models\entertainement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DayActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name',
        'description',
        'location',
        'visible',
        'joinable',
    ];

    protected $hidden = [];

    /**
     * Get all of the timing for the DayActivity
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function timing(): HasMany
    {
        return $this->hasMany(DayActivityTiming::class, 'et_id', 'id');
    }
}
