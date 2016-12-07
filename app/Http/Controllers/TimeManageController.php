<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Client;
use App\Project;
use App\Task;
use App\User;
use Validator;

class TimeManageController extends Controller
{
    /**
     * home page
     */

    public function index()
    {
        if (Auth::guest()) {
            return view('auth.login');
        }
        else {
            return view('layouts.index_template');
        }
    }

    /*
     * return all users
     * */

    public function all( $team = false )
    {
        if( $team != false ) {
            $users = User::where('team_name', '=', $team)->get();
        } else {
            $users = DB::table('users')->get();
        }

        return view('time_manage.users', compact('users'));
    }

    /*
     * return all teams
     * */

    public function team_all()
    {
        $teams = DB::table('teams')->get();

        return view('time_manage.teams', compact('teams'));
    }

    /*
     * create new clients
     * */

    public function create_client(Request $request)
    {
        if(Input::all() == true) {
            $this->validation_client($request);

            $client = Input::all();

            Client::create([
                'company_name' => $client['company_name'],
                'company_address' => $client['company_address'],
                'website' => $client['website'],
                'contact_person' => $client['contact_person'],
                'email' => $client['email'],
                'phone_number' => $client['phone_number']
            ]);

            return redirect('/');
        }
            //return view('');
    }

    /*
     * create project for company
     * */

    public function create_project(Request $request)
    {
        if(Input::all() == true) {
            $this->validation_project($request);

            $project = Input::all();

            Project::create([
                'client_id' => $project['company_id'],
                'company' => $project['company'],
                'project_name' => $project['project_name'],
                'hourly_rate' => $project['hourly_rate'],
                'notes' => $project['notes']
            ]);

            return redirect('/');
        }
        //$clients = Client::all();
        //return view('', compact('clients'));
    }

    /*
     * create tack for project
     * */

    public function create_task(Request $request)
    {
        if(Input::all() == true) {
            $this->validation_task($request);

            $task = Input::all();

            Task::create([
                'company_id' => $task['company_id'],
                'project_id' => $task['project_id'],
                'task_type' => $task['task_type'],
                'task_description' => $task['task_description']
            ]);

            //return redirect('/');
        }
        //$clients = Client::all();
        //return view('', compact('clients'));
    }

    /*
     * create new team
     * */

    public function create_team(Request $request)
    {
        if(Input::all() == true) {
            $this->validation_team($request);
            $team = Input::all();
            
            DB::table('teams')->insert([
                'team_name' => $team['team_name']
            ]);

           return redirect('/team/all');
        }

         return view('time_manage.forms.createTeamsForm');
    }

    /*
     * delete team from table teams
     * and change team_name field in table users
     * where this team used
     * */

    public function delete_team($id)
    {
        DB::table('users')
            ->where('team_name', '=', DB::table('teams')->where('id', '=', $id)->first()->team_name)
            ->update(['team_name' => 'no team']);
        DB::table('teams')->where('id', '=', $id)->delete();

        return redirect('/team/all');
    }

    /*
     * validation for clients action
     * */

    private function validation_client($request)
    {
        $this->validate($request, [
            'company_name' => 'required|min:4|max:30',
            'compane_address' => 'required|min:4|max:100',
            'website' => 'required|url',
            'contact_person' => 'required|min:4|max:30',
            'email' => 'required|email',
            'phone_number' => 'required|regex:/[0-9-]/|max:30'
        ]);
    }

    /*
     * validation for project
     * */

    private function validation_project($request)
    {
        $this->validate($request, [
            'company' => 'required|min:2|max:30',
            'project_name' => 'required|min:2|max:30',
            'hourly_rate' => 'numeric',
            'notes' => 'regex:/[a-zA-Z0-9]/|max:1000'
        ]);
    }

    /*
     * validation for task
     * */

    private function validation_task($request)
    {
        $this->validate($request, [
            'company_id' => 'integer|max:10',
            'project_id' => 'integer|max:10',
            'task_type' => 'required|min:2|max:30',
            'task_description' => 'required|regex:/[a-zA-Z0-9]/|max:1000'
        ]);
    }

    /*
     * validation for create team
     * */

    private function validation_team($request)
    {
        $this->validate($request, [
            'team_name' => 'required|min:2|max:30'
        ]);
    }
}