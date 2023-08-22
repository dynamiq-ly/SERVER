<?php

namespace App\Models\entertainement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NightShowTiming extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
        'start_time',
        'end_time',
        'location',
        'et_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get the night that owns the NightShowTiming
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function night(): BelongsTo
    {
        return $this->belongsTo(NightShow::class, 'et_id', 'id');
    }
}
