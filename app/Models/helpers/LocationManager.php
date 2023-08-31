<?php

namespace App\Models\helpers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationManager extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'belongToHotel'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
