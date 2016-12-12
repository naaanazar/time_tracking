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
    public function trecking()
    {
        if( Input::all() == true ) {
            TimeTrack::create( [ Input::all() ] );

            return true;
        }

        if( in_array(Auth::user()->employe, $this->users ) ) {
            $tasks = Task::where('assign_to', '=', Auth::user()->id )
                ->with('project', 'track', 'track_log')->get();

            $task = new Task();
            $tasks = $task->time_counter($tasks);
            
            return view('', compact('tasks'));
        }

        $tasks = Task::with('project', 'track', 'track_log')->get();
        $task = new Task();
        $tasks = $task->time_counter($tasks);

        return view('', compact('tasks'));
    }

    /*
     * create time log
     * action works with ajax
     * */
    public function create_time_log()
    {
        if( Input::all() == true ) {
            TimeLog::create( [ Input::all() ] );

            return true;
        }
        return false;
    }
}