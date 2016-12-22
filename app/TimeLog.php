<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TimeTrack;

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

    /*
     * count total time in trask log
     * */
    public function totalTime($data)
    {
        $start = $this::where('id', '=', $data['id'])
            ->select(['track_id', 'start'])
            ->first();

        $this->totalTimeTrack($start['track_id']);

        return strtotime($data['finish']) - strtotime($start['start']);
    }

    /*
     * count total tim in trask
     * */
    public function totalTimeTrack($id)
    {

        $logs = TimeLog::where('track_id', '=', $id)
            ->get();

        $count = 0;
        foreach( $logs as $log ) {
            $count += $log['attributes']['total_time'];
        }

        TimeTrack::where('id', '=', $id)
            ->update([
                'total_time' => (int)$count
            ]);

        return;
    }
}