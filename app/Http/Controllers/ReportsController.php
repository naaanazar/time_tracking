<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
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
            $day = date('d-m-Y');
        }
        $date = $day;

        $day = date('Y-m-d', strtotime($day));


        $data = date_create($day);

        $data1 = date_modify(date_create($day), '+1 day');

       // where('done', '=', 1)
        $tasks = Task::where('date_finish', '>', $data)
            ->where('date_finish', '<', $data1)
            ->with('client', 'project', 'user', 'track')
            ->get();

        $objectTask = new Task();

        $totalTime = 0;
        $totalValue = 0;

        foreach( $tasks as $key => $task ) {
            $total_time = 0;
            $value = 0;
            foreach( $task['relations']['track'] as $log) {
                if( strtotime($data->format('Y-m-d')) < strtotime($log['attributes']['date_finish']) && strtotime($data1->format('Y-m-d')) > strtotime($log['attributes']['date_finish']) ) {
                    $total_time += $log['attributes']['total_time'];
                    $value += $log['attributes']['value'];
                }
            }
            $tasks[$key]['total'] = $objectTask->time_add_00($objectTask->time_hour($total_time));
            $tasks[$key]['value'] = $value;
            $totalTime += $total_time;
            $totalValue += $tasks[$key]['value'];
        }

        $total['totalTime'] = $objectTask->time_add_00($objectTask->time_hour($totalTime));
        $total['totalValue'] = $totalValue;

        $dayReport = $tasks;

        return view('reports.dayliReport', compact('dayReport', 'date', 'total'));
    }

    /*
     * project report
     * */
    public function projectReport( $dateStart, $dateFinish ) // testing
    {
        $projects = Project::where('created_at', '>=', $dateStart)
            ->where('created_at', '<=', $dateFinish)
            ->with('user', 'task', 'track')
            ->get();

        $objectTask = new Task();

        foreach( $projects as $key => $project ) {
            $totalTime = 0;
            $value = 0;
            foreach( $project['relations']['track'] as $track ) {
                $totalTime += $track['attributes']['total_time'];
                $value += $track['attributes']['value'];
            }

            $projects[ $key ]['value'] = $value;
            $projects[ $key ]['total_time'] = $objectTask->time_hour($totalTime);
            $projects[ $key ]['cost'] = $objectTask->time_hour($totalTime) * $projects[ $key ]['original']['hourly_rate'];
            $projects[ $key ]['economy'] = $projects[ $key ]['value'] - $projects[ $key ]['cost'];
        }

        return $projects;
    }

    /*
     * people report
     * $userId - id user
     * */
    public function peopleReport( $dateStart=false, $dateFinish=false, $userId=false)
    {
        if (!isset($dateStart) && !isset($dateFinish) && !isset($userId)){
             return back();
        }
            $tasks = Task::where('done', '=', 1)
                ->where('assign_to', '=', $userId)
                ->where('date_finish', '>=', $dateStart)
                ->where('date_finish', '<=', $dateFinish)
                ->with('project', 'user', 'track')
                ->get();

            $objectTask = new Task();

            foreach ($tasks as $key => $task) {
                $totalTime = 0;

                foreach ($task['relations']['track'] as $track) {
                    $totalTime += $track['attributes']['total_time'];
                }

                $totalTime = $objectTask->time_hour($totalTime);

                $tasks[$key]['value'] = $task['relations']['project']['attributes']['hourly_rate'] * $totalTime;
                $tasks[$key]['cost'] = $totalTime * $task['relations']['user']['attributes']['hourly_rate'];
                $tasks[$key]['economy'] = $tasks[$key]['value'] - $tasks[$key]['cost'];
            }

            $date['start'] = $dateStart;
            $date['finish'] = $dateFinish;

            $peopleReport = $tasks;

            $users = $this->allUsersJson();

            return view('reports.peopleReport', compact('peopleReport', 'date', 'users'));

    }

    public function allUsersJson(){

        $users = DB::table('users')
            ->select('users.id',
                'users.name',
                'users.email',
                'users.users_team_id',
                'users.hourly_rate',
                'users.created_at',
                'users.employe'
            )
            ->get();

        foreach ($users as $key){

            if ($key->employe == 'Lead'){
                 $allUsers['Lead'][] = $key;
            }
            if ($key->employe == 'Developer'){
                $allUsers['Developer'][] = $key;
            }
            if ($key->employe == 'QA Engineer'){
                $allUsers['QA Engineer'][] = $key;
            }
            if ($key->employe == 'Supervisor'){
                $allUsers['Supervisor'][] = $key;
            }
            if ($key->employe == 'Admin'){
                $allUsers['Admin'][] = $key;
            }
        }

        return $allUsers;
    }
}