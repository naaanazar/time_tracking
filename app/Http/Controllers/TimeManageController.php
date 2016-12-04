<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Mail;

use App\Mail\mailCreateUser;



class TimeManageController extends Controller
{
    /**
     * home page
     */


    public function index()
    {

       // Mail::to('naaa@ukr.net')->send(new mailCreateUser);

        if (Auth::guest()) {
            return view('auth.login');
        }
        else {
           // return view('time_manage.index');
            return view('layouts.index_template');
        }
    }
}
