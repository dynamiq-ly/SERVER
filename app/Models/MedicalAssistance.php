<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalAssistance extends Model
{
    use HasFactory;

    protected $fillable = [
        'request',
        'description',
        'isAnsexred',
        'room_number',
    ];


    protected $hidden = [
        'updated_at',
        'created_at',
    ];
}
