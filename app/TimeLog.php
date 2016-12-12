<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeLog extends Model
{
    protected $table = 'time_log';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'task_id',
        'start',
        'finish'
    ];

    public function time_track()
    {
        return $this->belongsTo('App\TimeTrack', 'track_id', 'id');
    }
}