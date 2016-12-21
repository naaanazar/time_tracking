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

        /*echo "<pre>";
       // var_dump( $tracks); //die();
        foreach ($tracks as $key){
            var_dump($key);
          //  var_dump($key->project->project_name);
           // var_dump($key->duration);
        }

        echo "</pre>";*/

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

            return view('time_track.time_track', compact('tasks', 'date', 'tracks'));

        } elseif ( Auth::user()->employe == 'Admin' || Auth::user()->employe == 'Supervisor' ) {
            $tasks = Project::with('task', 'track', 'track_log')->get();
            $tasks = $task->time_counter($tasks);

            return view('time_track.time_track', compact('tasks', 'date', 'tracks'));
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
        $tracks = TimeTrack::with('task', 'project')->get();

        return view('', compact('tracks'));
    }

    /*
     * create time log
     * action works with ajax
     * */
    public function create_time_log( $id = false )
    {
        if( $id == true ) {
            TimeLog::where('id', '=', $id)->update([ Input::all() ]);
            return true;
        }

        if( Input::all() == true ) {
            TimeLog::create( [ Input::all() ] );

            return true;
        }
        return false;
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
            'description' => 'max:1000',
            'additional_cost' => 'integer',
            'billable_time' => ''
        ]);
    }

    public function getTimeNow(){
        $data = time();

        return response()->json(['data' => $data]);
    }

    public function test()
    {
        $users = User::where('id', '>', '1')
            ->orderby('name', 'asc')
            ->get();
        foreach( $users as $user )
        {
            echo '<pre>'; var_dump($user->name); echo '</pre>';
        }
    }
}