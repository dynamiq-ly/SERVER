<?php

namespace App\Models\entertainement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'lots_teams',
        'location',
        'category',
        'day',
        'start_time',
        'end_time',
        'slug',
        'banner_image',
        'home_team_name',
        'home_team_logo',
        'away_team_name',
        'away_team_logo',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
