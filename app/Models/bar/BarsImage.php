<?php

namespace App\Models\bar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarsImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'bar_id',
    ];

    protected $hidden = [
        'bar_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the bar that owns the BarsImage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bar(): BelongsTo
    {
        return $this->belongsTo(BarsList::class, 'bar_id', 'id');
    }
}
