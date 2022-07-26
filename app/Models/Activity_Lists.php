<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Activity_Lists extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'activity_list_name',
        'activity_list_duration',
        'activity_list_thumbnail',
        'activity_list_description',
        'activity_list_meeting_point',
        'activity_list_required_equipment',
        'activity_list_zone',
        'activities_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
    ];

    /**
     * Get the user that owns the Activity_Lists
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function activityName(): BelongsTo
    {
        return $this->belongsTo(Activities::class, 'activities_id');
    }
}
