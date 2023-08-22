<?php

namespace App\Models\entertainement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DayActivityTiming extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
        'start_time',
        'end_time',
        'age',
        'et_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    /**
     * Get the day that owns the DayActivityTiming
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function activity(): BelongsTo
    {
        return $this->belongsTo(DayActivity::class, 'et_id', 'id');
    }
}
