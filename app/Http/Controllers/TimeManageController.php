<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

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
