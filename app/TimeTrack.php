<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeTrack extends Model
{
    protected $table = 'time_track';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'task_id',
        'approve',
        'project_id',
        'date_start',
        'track_date',
        'description',
        'date_finish',
        'duration',
        'billable_time',
        'additional_cost',
        'total_time'
    ];

    public function timeLog()
    {
        return $this->hasMany('App\TimeLog', 'id', 'track_id');
    }

    public function task()
    {
        return $this->belongsTo('App\Task', 'task_id', 'id');
    }

    public function project()
    {
        return $this->belongsTo('App\Project', 'project_id', 'id');
    }


}