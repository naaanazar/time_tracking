<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;

class UsersController extends Controller
{
    /*
     * create new user
     * */
    public function create_user()
    {
        $data = Input::all();

        User::create([
            'name' => 'terror',
            'email' => 'terrorist@gmail.com',
            'password' => bcrypt('123456'),
            'team_name' => '',
            'hourly_rate' => ''
        ]);

        return;
    }
    /*
     * update user
     * $id - user id
     * */
    public function update_user($id)
    {
        echo 'update_user - ' . $id;
    }
    /*
     * delete user
     * $id - user id
     * */
    public function delete_user($id)
    {
        echo 'delete_user - ' . $id;
    }
}