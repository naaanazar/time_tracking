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
        'project_id',
        'task_id',
        'track_id',
        'start',
        'finish'
    ];

    public function time_track()
    {
        return $this->belongsTo('App\TimeTrack', 'track_id', 'id');
    }

    public function task()
    {
        return $this->belongsTo('App\Task', 'task_id', 'id');
    }

    public function project()
    {
        return $this->belongsTo('App\Project', 'project_id', 'id');
    }

    public function totalTime($data)
    {
        $start = $this::where('id', '=', $data['id'])
            ->select('start')
            ->first();

        return strtotime($data['finish']) - strtotime($start);
    }
}