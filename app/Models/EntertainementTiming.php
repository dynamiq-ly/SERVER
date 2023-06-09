<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EntertainementTiming extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'time_start',
        'time_end',
        'duration',
        'is_repetetive',
        'entertainement_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'entertainement_id',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the entertainement that owns the EntertainementTiming
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entertainement(): BelongsTo
    {
        return $this->belongsTo(Entertainement::class, 'entertainement_id', 'id');
    }
}
