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
        'Developer',
        'QA Engineer',
        'Lead'
    ];

    /*
     * trecing time action
     * */
    public function trecking(Request $request)
    {
        if( Input::all() == true ) {
            $this->validation_track($request);

            TimeTrack::create( Input::all() );

            return true;
        }

        $task = new Task();

        if( in_array(Auth::user()->employe, $this->users ) ) {
            $tasks = Task::where('assign_to', '=', Auth::user()->id )
                ->with('track', 'track_log')->get();

            $tasks = $task->time_counter($tasks);

            return view('', compact('tasks'));
        }

        $tasks = Project::with('task', 'track', 'track_log')->get();
        $tasks = $task->time_counter($tasks);

        return view('time_track.time_track', compact('tasks'));
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
            'date_start' => '',
            'date_finish' => '',
            'duration' => 'required|1000',
            'additional_cost' => 'required|integer',
            'Billable_time' => ''
        ]);
    }
}