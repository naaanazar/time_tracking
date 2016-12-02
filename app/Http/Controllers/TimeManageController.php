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
        return view('time_manage.index');
    }
}
