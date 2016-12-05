<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
          //  return view('time_manage.index');
           // return view('layouts.index_template');
             return view('auth.registration');
        }
    }
}
