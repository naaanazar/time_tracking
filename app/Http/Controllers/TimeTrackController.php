<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Project;
use App\Task;
use App\TimeTrack;
use App\TimeLog;
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
    public function trecking(Request $request)
    {
        $task = new Task();

        if( Input::all() == true ) {
            $this->validation_track($request);
            $data = Input::all();

            if( isset( $data['date_start'] ) && isset( $data['date_finish'] ) ) {
                $data['date_start'] = $task->time_parser_from_js($data['date_start']);
                $data['date_finish'] = $task->time_parser_from_js($data['date_finish']);
            }
            if( isset( $data['duration'] ) ){
                $data['duration'] = $task->parse_duration($data['duration']);
            }

            TimeTrack::create( $data );

            return redirect('/trecking');
        }

        if( in_array(Auth::user()->employe, $this->users ) ) {
            $tasks = Project::where('lead_id', '=', Auth::user()->id )
                ->with('task', 'track', 'track_log')->get();

            $tasks = $task->time_counter($tasks);

            return view('time_track.time_track', compact('tasks'));

        } elseif ( Auth::user()->employe == 'Admin' || Auth::user()->employe == 'Supervisor' ) {
            $tasks = Project::with('task', 'track', 'track_log')->get();
            $tasks = $task->time_counter($tasks);

            return view('time_track.time_track', compact('tasks'));
        }

        return redirect('/');
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
}