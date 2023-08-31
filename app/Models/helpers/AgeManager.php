<?php

namespace App\Models\helpers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgeManager extends Model
{
    use HasFactory;

    protected $fillable = [
        "age",
        "age_group"
    ];


    protected $hidden = [
        "created_at",
        "updated_at"
    ];
}
