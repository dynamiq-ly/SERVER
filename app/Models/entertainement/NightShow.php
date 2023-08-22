<?php

namespace App\Models\entertainement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NightShow extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name',
        'description',
        'genre',
        'visible',
        'joinable',
        'youtube_link',
        'website_link',
        'host_name',
        'host_image',
        'host_role',
        'host_description',
    ];

    protected $hidden = [];

    /**
     * Get all of the timing for the NightShow
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function timing(): HasMany
    {
        return $this->hasMany(NightShowTiming::class, 'et_id', 'id');
    }
}
