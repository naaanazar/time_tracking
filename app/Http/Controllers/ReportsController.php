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
                if( strtotime($data->format('Y-m-d')) < strtotime($log['attributes']['finish_track']) && strtotime($data1->format('Y-m-d')) > strtotime($log['attributes']['finish_track']) ) {
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
    public function projectReport( $dateStart = false, $dateFinish = false, $projectId = false) // testing
    {
        if (!isset($dateStart) && !isset($dateFinish) && !isset($projectId)){
            return back();
        }
        $active['projectId'] = $projectId;
        $active['start'] = $dateStart;
        $active['end'] =$dateFinish;

        $dateFinish = date_modify(date_create($dateFinish), '+1 day');

        $projectReport = Task::where('project_id', '=', $projectId)
            ->where('date_finish', '>=', $dateStart)
            ->where('date_finish', '<=', $dateFinish)
            ->with('user', 'project', 'track')
            ->get();

        $objectTask = new Task();

        $totalValue = 0;
        $totalTime = 0;
        $totalCost = 0;
        $totalEconomy = 0;

        foreach( $projectReport as $key => $task ) {
            $hours = 0;
            $value = 0;
            $cost = 0;
            $economy = 0;
            foreach($task['relations']['track'] as $track) {
                $hours += $track['attributes']['total_time']; // seconds
                $value += $objectTask->value($track['attributes']['total_time'], $projectReport[$key]['relations']['project']['attributes']['hourly_rate']);
                $cost += $objectTask->value($track['attributes']['total_time'], $projectReport[$key]['relations']['user']['attributes']['hourly_rate']);
                $economy += ($value - $cost);
            }

            $projectReport[$key]['hours'] = $objectTask-> secondToHour($hours);
            $projectReport[$key]['value'] = $value;
            $projectReport[$key]['cost'] = $cost;
            $projectReport[$key]['economy'] = $economy;

            $totalTime += $hours;
            $totalValue += $value;
            $totalCost += $cost;
            $totalEconomy += $economy;
        }

        $total['totalCost'] = $totalCost;
        $total['totalTime'] = $objectTask-> secondToHour($totalTime);
        $total['totalValue'] = $totalValue;
        $total['totalEconomy'] = $totalEconomy;

        $date['start'] = $dateStart;
        $date['finish'] = $dateFinish;

        $projectsList = DB::table('Project')
            ->select('Project.project_name', 'Project.id')
            ->get();

        return view('reports.projectReport', compact('projectReport', 'total', 'date', 'projectsList', 'active'));
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
        $active['userId'] = $userId;
        $active['start'] = $dateStart;
        $active['end'] =$dateFinish;

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

            foreach( $task['relations']['project']['track'] as $keys => $trask ) {
                if ( $task['relations']['project']['track'][$keys]['approve'] == 1 ) {
                    $tasks[$key]['hours'] = $objectTask->time_hour($hours);
                    $tasks[$key]['volue'] = $objectTask->value($totalTime, $task['relations']['project']['attributes']['hourly_rate']);
                    $tasks[$key]['cost'] = $objectTask->value($totalTime, $task['relations']['user']['attributes']['hourly_rate']);
                    $tasks[$key]['economy'] = $tasks[$key]['value'] - $tasks[$key]['cost'];

                    $totalValue += $tasks[$key]['volue'];
                    $totalCost += $tasks[$key]['cost'];
                    $totalEconomy += $tasks[$key]['economy'];
                }
            }

            if ( !isset($tasks[$key]['hours'])) {
                $tasks[$key]['hours'] = '-';
                $tasks[$key]['volue'] = '-';
                $tasks[$key]['cost'] = '-';
                $tasks[$key]['economy'] = '-';

                $totalValue += 0;
                $totalCost += 0;
                $totalEconomy += 0;
           }
        }

        $total['totalValue'] = $totalValue;
        $total['totalCost'] = $totalCost;
        $total['totalEconomy'] = $totalEconomy;

        $date['start'] = $dateStart;
        $date['finish'] = $dateFinish;

        $peopleReport = $tasks;
        $users = $this->allUsersJson();

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