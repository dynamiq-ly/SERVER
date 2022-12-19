<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GymEquipment extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'gym_equipement_name',
        'gym_equipment_image',
        'gym_id'
       
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'gym_id'
        
    ];

    /**
     * Get the gym that owns the GymEquipment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class, 'gym_id', 'id');
    }
}
