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
        'date_start',
        'date_finish',
        'additional_cost',
        'total_time'
    ];

    public function time_log()
    {
        return $this->hasMany('App\TimeLog');
    }
}