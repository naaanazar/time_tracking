<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Router;

class Permision
{
    protected $router;
    protected $permision_list = [
        'Admin' => ['logout', 'login', 'index'],
        'Supervisor' => ['logout', 'login', 'index'],
        'Lead' => ['logout', 'login', 'index'],
        'Developer' => ['logout', 'login', 'index'],
        'QA_Engineer' => ['logout', 'login', 'index'],
        'HR_Manager' => ['logout', 'login', 'index']
    ];

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function handle($request,  Closure $next)
    {
        $action_name = explode('@', $this->router->getRoutes()->match($request)->getActionName());

        if(false/*for unlogin user*/) {
           return redirect('/users/login');
        } elseif (in_array($action_name[1], $this->permision_list['Admin'])) {
            return $next($request);
        } else {
            return $next($request);//redirect()->back();
        }
    }
}