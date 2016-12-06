<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

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
}
