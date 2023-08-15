<?php

namespace App\Models\gym;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gym extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
        'location',
        'terms',
        'description',
        'timing-open',
        'timing-close',
        'reservation',
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
     * Get all of the comments for the Activities
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function staff(): HasMany
    {
        return $this->hasMany(GymStaff::class, 'gym_id', 'id');
    }

    /**
     * Get all of the comments for the Activities
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function equipements(): HasMany
    {
        return $this->hasMany(GymEquipement::class, 'gym_id', 'id');
    }
}
