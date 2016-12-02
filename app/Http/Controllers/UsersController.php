<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
class UsersController extends Controller
{
    /*
     * login
     * */
    public function login()
    {
        echo 'login';
    }
    /*
     * logout user
     * */
    public function logout()
    {
        echo 'logout';
    }
    /*
     * create user
     * */
    public function create_user()
    {
        echo 'create_user';
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