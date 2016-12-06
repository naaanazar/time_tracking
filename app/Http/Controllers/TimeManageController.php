<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\TimeManage;
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

    public function all()
    {
        $users = DB::table('users')->get();

        return view('time_manage.users', compact('users'));
    }

    public function team_all()
    {
        $teams = DB::table('users')->get();

        return view('', compact('teams'));
    }

    public function create_client(Request $request)
    {
        if(Input::all() == true) {
            $this->validation($request);

            $client = Input::all();

            TimeManage::create([
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

    public function create_team(Request $request)
    {
        if(Input::all() == true) {
            $this->validation($request);

            $team = Input::all();
            
            DB::table('teams')->insert([
                'team_name' => $team['team_name']
            ]);

            return redirect('/user/all');
        }

        // return view('');
    }

    public function delete_team(Request $request, $id)
    {
        DB::table('teams')->where('id', '=', $id)->delete();

        return redirect('/user/all');
    }

    private function validation($request)
    {
        $this->validate($request, [
            'company_name' => 'required|min:4|max:30',
            'compane_address' => 'required|min:4|max:100',
            'website' => 'required|url',
            'contact_person' => 'required|min:4|max:30',
            'email' => 'required|email',
            'phone_number' => 'required|regex:/[0-9-]/|max:30',
            'team' => 'required|min:4|max:30'
        ]);
    }
}
