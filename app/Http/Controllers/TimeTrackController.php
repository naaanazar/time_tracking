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

class TimeTrackController extends Controller
{
    /*
     * permission for trecking time
     * */
    protected $users = [
        'Lead'
    ];

    /*
     * trecing time action
     * */
    public function trecking(Request $request, $date=false)
    {
        $task = new Task();

        if (!$date) {
            $date =  date('d-m-Y');
        }

        $tracks = TimeTrack::with('task', 'project')
            ->where('track_date', '=', date('Y-m-d', strtotime($date)))
            ->get();


        if( Input::all() == true ) {
            $this->validation_track($request);
            $data = Input::all();

            if( $data['date_start'] != '' && $data['date_finish'] != '' ) {
                $data['date_start'] =  $task->time_parser_from_js($data['date_start']);
                $data['date_finish'] = $task->time_parser_from_js($data['date_finish']);
            } elseif( $data['date_start'] == '' && $data['date_finish'] == '' ) {
                unset($data['date_start']);
                unset($data['date_finish']);
            }
            if( $data['additional_cost'] == '') {
                $data['additional_cost'] = 0;
            }
            if( isset( $data['duration'] ) ){
                $data['duration'] = $task->parse_duration($data['duration']);
            }
            if( $data['date_duration'] != '' ){
                $data['duration'] = $task->parse_duration($data['date_duration']);
            }
            $data['track_date'] = date('Y-m-d', strtotime($data['track_date']));
            
            TimeTrack::create( $data );

            return redirect('/trecking');
        }

        if( in_array(Auth::user()->employe, $this->users ) ) {
            $tasks = Project::where('lead_id', '=', Auth::user()->id )
                ->with('task', 'track', 'track_log')->get();
            $tasks = $task->time_counter($tasks);

            return view('time_track.time_track', compact('tasks', 'date', 'tracks', 'timeLog'));

        } elseif ( Auth::user()->employe == 'Admin' || Auth::user()->employe == 'Supervisor' ) {
            $tasks = Project::with('task', 'track', 'track_log')->get();
            $tasks = $task->time_counter($tasks);

            return view('time_track.time_track', compact('tasks', 'date', 'tracks', 'timeLog'));
        }

        return redirect('/');
    }

    /*
     * update track log
     * */
    public function update_track( Request $request, $track_id, $date = false )
    {
        $task = new Task();

        if (!$date) {
            $date =  date('d-m-Y');
        }

        $tracks = TimeTrack::with('task', 'project')
            ->where('track_date', '=', date('Y-m-d', strtotime($date)))
            ->get();

        if( Input::all() == true ) {
            $this->validation_track($request);
            $data = Input::all();

            if( $data['date_start'] != '' && $data['date_finish'] != '' ) {
                $data['date_start'] = $task->time_parser_from_js($data['date_start']);
                $data['date_finish'] = $task->time_parser_from_js($data['date_finish']);
            } elseif( $data['date_start'] == '' && $data['date_finish'] == '' ) {
                unset($data['date_start']);
                unset($data['date_finish']);
            }
            if( $data['additional_cost'] == '') {
                $data['additional_cost'] = 0;
            }
            if( isset( $data['duration'] ) ){
                $data['duration'] = $task->parse_duration($data['duration']);
            }
            if( $data['date_duration'] != '' ){
                $data['duration'] = $task->parse_duration($data['date_duration']);
            }
            $data['track_date'] = date('Y-m-d', strtotime($data['track_date']));
            unset($data['_token']);
            unset($data['date_duration']);

            TimeTrack::where('id', '=', $track_id)->update( $data );

            return redirect('/trecking');
        }

        if( in_array(Auth::user()->employe, $this->users ) ) {
            $tasks = Project::where('lead_id', '=', Auth::user()->id )
                ->with('task', 'track', 'track_log')->get();
            $tasks = $task->time_counter($tasks);
            $track = TimeTrack::where('id', '=', $track_id)
                ->with('project', 'task')
                ->get();

            $track[0]['duration'] = $task->time_minute($track[0]['attributes']['duration']);

            return view('time_track.time_track', compact('tasks', 'track', 'date', 'tracks'));

        } elseif ( Auth::user()->employe == 'Admin' || Auth::user()->employe == 'Supervisor' ) {
            $tasks = Project::with('task', 'track', 'track_log')->get();
            $tasks = $task->time_counter($tasks);
            $track = TimeTrack::where('id', '=', $track_id)
                ->with('project', 'task')
                ->get();

            $track[0]['duration'] = $task->time_minute($track[0]['attributes']['duration']);

            return view('time_track.time_track', compact('tasks', 'track', 'date', 'tracks'));
        }

        return redirect('/');
    }

    /*
     * delete time track
     * */
    public function delete_track($id)
    {
        TimeTrack::where('id', '=', $id)->delete();

        return redirect('/trecking');
    }

    /*
     * return all track
     * */
    public function all_track()
    {
        $tasks = Task::with('project', 'track', 'user')->get();

        return view('', compact('tasks'));
    }

    /*
     * create time log
     * action works with ajax
     * */

    public function getTimeLogById($id){


        $timeLog = TimeLog::where('track_id', '=', $id)->
        with('task', 'project')->get();

        //var_dump($timeLog);

        return response()->json(['data' => (object)$timeLog]);
    }

    /*
     * create time log
     * */
    public function create_time_log( $id = false )
    {


        $data =  Input::all();
        if( isset($data['id'])) {
            $this->trackFinish($data['id']);

            return back();
        }



        if( Input::all() == true ) {

            if(isset($_COOKIE['logTrackActiveLogId'])){
                $this->trackFinish($_COOKIE['logTrackActiveLogId']);
            }

            $start =  Input::all();
            $start['start'] = date('Y-m-d H:i:s');

            TimeLog::create($start);

            $timeLog = Timelog::orderBy('id', 'desc')
                ->select(['id', 'start'])
                ->limit(1)
                ->get();



            setcookie('logTrackActiveStart', $start["start"], time() + (86400 * 30), "/");
            setcookie('logTrackActiveLogId', $timeLog[0]->id, time() + (86400 * 30), "/");
            setcookie('logTrackActiveTrackId', $start["track_id"], time() + (86400 * 30), "/");

            return response()->json(['data' => (object)$timeLog]);
        }

        return false;
    }

    private function trackFinish($id)
    {
        $data['finish'] = date('Y-m-d H:i:s');
        $data['id'] = $id;


        ( new TimeLog() )->totalTime($data);

        setcookie("logTrackActiveStart", "", time()-10, "/");
        setcookie("logTrackActiveTrackId", "", time()-10, "/");
        setcookie("logTrackActiveLogId", "", time()-10, "/");
    }
    /*
     * delete time log
     * */
    public function deleteTraskLog( $id )
    {
        $traskId = 0;
        $traskId = TimeLog::where('id', '=', $id)
            ->select('track_id')
            ->first();

        TimeLog::where('id', '=', $id)
            ->delete();

        (new TimeLog())->totalTimeTrack( $traskId['attributes']['track_id'] );

        return redirect('/trecking');
    }

    public function getTasks($project_id)
    {
        $result = Task::where('project_id', '=', $project_id)->get();
        if ($result) {
            return response()->json(['data' => (object)$result]);
        } else {
            return response()->json(['data' => 'false']);
        }

        return response()->json(['data' => (object)$result]);
    }

    private function validation_track($request)
    {
        $this->validate($request, [
            'task_id' => 'required',
            'project_id' => 'required',
            'date_start' => '',
            'date_finish' => '',
            'description' => 'required|max:1000',
            'additional_cost' => 'integer',
            'billable_time' => ''
        ], [
            'description.required' => 'field can not be blank'
        ]);
    }

    public function getTimeNow(){
        $data = date('Y-m-d H:i:s');

        return response()->json(['data' => $data]);
    }

    /*
     * test action
     * */
    public function test()
    {
        $this->deleteTraskLog('35');
    }
}