<?php

namespace App\Models\room;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomsListAdsOns extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'featured',
        'image',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
