<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'project_id',
        'task_titly',
        'alloceted_hours',
        'assign_to',
        'task_type',
        'task_description',
        'billable'
    ];

    public function client()
    {
        return $this->belongsTo('App\Client', 'company_id', 'id');
    }

    public function project()
    {
        return $this->belongsTo('App\Project', 'project_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'assign_to', 'id');
    }

    public function track()
    {
        return $this->hasMany('App\TimeTrack');
    }

    public function track_log()
    {
        return $this->hasMany('App\TimeLog');
    }

    public function time_counter($data)
    {
        foreach( $data as $value ) {
            foreach( $value->track_log as $val )
            {
                $diff = strtotime(date('Y-m-d h:i:s')) - strtotime($val->start);
                $value->track_log->time_diff = $this->time_diff($diff);
            }
        }

        return $data;
    }

    protected function time_diff($second)
    {
        $difference = bcmod($second, 3600);
        $result['hour'] = (int)($second/3600);
        $result['minutes'] = (int)($difference/60);
        $result['second'] = bcmod($difference, 60);

        return $result;
    }
}