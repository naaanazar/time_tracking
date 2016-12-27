<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Project;
use App\Task;
use App\TimeTrack;
use App\TimeLog;
use App\User;
use Validator;

class ReportsController extends Controller
{
    /*
     * daily report
     * $id - task id
     * $day - day of reports
     * */
    public function dailyReport($day=false)
    {

        if($day == false) {
            $day = date('Y-m-d');
        }

        $day = date('Y-m-d', strtotime($day));


        $data = date_create($day);
        $data1 = date_modify($data, '+1 day');

        $tasks = Task::where('date_finish', '>', $data)
            ->where('date_finish', '<', $data1)
            ->with('client', 'project', 'user', 'track')
            ->get();

        $objectTask = new Task();

        foreach( $tasks as $key => $task ) {
            $total_time = 0;
            foreach( $task['relations']['track'] as $log) {
                $total_time += $log['attributes']['total_time'];
            }
            $tasks[$key]['total'] = $objectTask->time_hour($total_time);
            $tasks[$key]['value'] = $total_time*$tasks[$key]['relations']['user']['attributes']['hourly_rate'];
        }

        return view('reports.dayliReport', compact('trasks'));
    }

    /*
     *
     * */
    public function projectReport()
    {

    }
}