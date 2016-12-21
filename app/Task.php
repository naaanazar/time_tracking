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

    public function time_parser_from_js($time = false)
    {
        if( $time != false ) {
            $date = explode( ' ', $time );
            unset($date[6]);
            unset($date[7]);
            $date = implode(' ', $date);

            $date = date( 'Y-m-d H:i:s', strtotime( $date ));
            return $date;
        }

        return 0;
    }

    public function time_parser($time = false)
    {
        if( $time != false ) {
            $time = explode(' ', $time);
            $time[5] = (int)(preg_replace('/[+,0,:]/', '', $time[5]));
            $diff = ((int)(date('O')) - $time[5])*3600;

            return $diff;
        }

        return 0;
    }

    public function time_counter($data)
    {
        foreach( $data as $value ) {
            foreach( $value->track_log as $val )
            {

                $diff = strtotime(date('Y-m-d H:i:s')) - strtotime($val->start);// - $this->time_parser($val->start);

                $value->track_log->time_diff = $this->time_diff($diff);
            }
        }

        return $data;
    }

    public function duration($date)
    {
        return $date = strtotime($date['date_finish']) - strtotime($date['date_start']);
    }

    protected function time_diff($second)
    {
        $difference = bcmod($second, 3600);
        $result['hour'] = (int)($second/3600);
        $result['minutes'] = (int)($difference/60);
        $result['second'] = bcmod($difference, 60);

        return $result;
    }

    public function parse_duration($time)
    {
        $data = explode(':', $time);
        return $data = ((int)($data[0]))*60 + (int)($data[1]);
    }

    public function time_minute($minute)
    {
        $minutes = bcmod($minute, 60);
        $houers = (int)($minute/60);

        return $result = $houers . ':' . $minutes;
    }
}