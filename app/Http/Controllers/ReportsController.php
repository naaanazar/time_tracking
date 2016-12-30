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
            ->where('date_finish', '<=', $data1)
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
            $tasks[$key]['total'] = $objectTask->time_add_00($objectTask->secondToHour($total_time));
            $tasks[$key]['value'] = $value;
            $totalTime += $total_time;
            $totalValue += $tasks[$key]['value'];
        }

        $total['totalTime'] = $objectTask->time_add_00($objectTask->secondToHour($totalTime));
        $total['totalValue'] = $totalValue;

        $dayReport = $tasks;
        //echo'<pre>'; var_dump($tasks); echo'</pre>';
        return view('reports.dayliReport', compact('dayReport', 'date', 'total'));
    }

    /*
     * project report
     * */
    public function projectReport( $dateStart=false, $dateFinish=false, $projectId=false )
    {
        $projects = Project::where('created_at', '>=', $dateStart)
            ->where('created_at', '<=', $dateFinish)
            ->with('user', 'track')

            ->get();

        $objectTask = new Task();

        $totalValue = 0;
        $totalTime = 0;
        $totalCost = 0;
        $totalEconomy = 0;

        foreach( $projects as $key => $project ) {
            $totalTime = 0;
            $value = 0;
            foreach( $project['relations']['track'] as $track ) {
                $totalTime += $track['attributes']['total_time'];
                $value += $track['attributes']['value'];
            }

            $projects[ $key ]['value'] = $value;
            $projects[ $key ]['total_time'] = $objectTask->secondToHour($totalTime);
            $projects[ $key ]['cost'] = $objectTask->secondToHour($totalTime) * $projects[ $key ]['original']['hourly_rate'];
            $projects[ $key ]['economy'] = $projects[ $key ]['value'] - $projects[ $key ]['cost'];

            $totalValue += $projects[ $key ]['value'];
            $totalTime += $projects[ $key ]['total_time'];
            $totalCost += $projects[ $key ]['cost'];
            $totalEconomy += $projects[ $key ]['economy'];
        }

        $total['totalValue'] = $totalValue;
        $total['totalTime'] = $totalTime;
        $total['totalCost'] = $totalCost;


        $date['start'] = $dateStart;
        $date['finish'] = $dateFinish;

        $projectsList = DB::table('Project')
            ->select('Project.project_name',
                'Project.id')
            ->get();

        return view('reports.projectReport', compact('projects', 'date', 'projectsList', 'total'));
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
        $dateFinish = date_modify(date_create($dateFinish), '+1 day');
        //where('done', '=', 1)
            $tasks = Task::where('assign_to', '=', $userId)
                ->where('date_finish', '>=', $dateStart)
                ->where('date_finish', '<=', $dateFinish)
                ->with('project', 'user', 'track')
                ->get();

            $objectTask = new Task();

        $totalValue = 0;
        $totalCost = 0;
        $totalEconomy = 0;

        foreach( $tasks as $key => $task ) {
            $totalTime = 0;
            $hours = 0;

            foreach ($task['relations']['track'] as $track) {
                $totalTime += $track['attributes']['total_time'];
                $hours += $track['attributes']['total_time'];
            }

            $tasks[ $key ]['hours'] = $objectTask->time_hour($hours);
            $tasks[ $key ]['value'] = $objectTask->value($totalTime, $task['relations']['project']['attributes']['hourly_rate']);
            $tasks[ $key ]['cost'] =  $objectTask->value( $totalTime, $task['relations']['user']['attributes']['hourly_rate'] );
            $tasks[ $key ]['economy'] = $tasks[ $key ]['value'] - $tasks[ $key ]['cost'];

            $totalValue += $tasks[ $key ]['value'];
            $totalCost += $tasks[ $key ]['cost'];
            $totalEconomy += $tasks[ $key ]['economy'];
        }

        $total['totalValue'] = $totalValue;
        $total['totalCost'] = $totalCost;
        $total['totalEconomy'] = $totalEconomy;

        $date['start'] = $dateStart;
        $date['finish'] = $dateFinish;

        $peopleReport = $tasks;

        $users = $this->allUsersJson();

        $active['userId'] = $userId;

        return view('reports.peopleReport', compact('peopleReport', 'date', 'users', 'total', 'active'));

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