<?php

namespace App\Models\bar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarsStaff extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'image',
        'bar_id',
    ];

    protected $hidden = [
        'bar_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the bar that owns the BarsStaff
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bar(): BelongsTo
    {
        return $this->belongsTo(BarsList::class, 'bar_id', 'id');
    }
}
