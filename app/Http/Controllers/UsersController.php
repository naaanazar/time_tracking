<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\User;
use Validator;
use Illuminate\Http\Request;

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
    public function create()
    {
        if(Input::all() == true) {
            $user = Input::all();
            $user['password'] = $this->password_generate();

            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => bcrypt($user['password']),
                'employe' => $user['employe'],
                'team_name' => $user['team_name']
            ]);

            return redirect('/');
        }

        $teams = DB::table('teams')->get();

        return view('auth.registration', compact('teams'));
    }
    /*
     * update user
     * $id - user id
     * */
    public function update($id)
    {
        if(User::where('id', '=', $id) == true) {
            $user = Input::all();

            User::where('id', '=', $id)->update([
                'name' => $user('name'),
                'email' => $user('email'),
                'password' => bcrypt($user('password')),
                'employe' => $user('employe'),
                'team_name' => $user('team_nmae')
            ]);

            return redirect('/');
        }
        return view('layouts.index_template');
    }
    /*
     * delete user
     * $id - user id
     * */
    public function delete($id)
    {
        User::where('id', '=', $id)->delete();

        return redirect('/');
    }

    protected function store (Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:30',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6|max:20',
            'employe' => 'required|max:20',
            'team_name' => 'required|min:2|max:20'
        ]);
    }

    protected function password_generate()
    {
        $chars = 'abdefhiknsdfdsfdfdghhjDASDFFFDFewrewrererewerewrrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < 10; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }

        return substr(md5(rand(1, 10000) . 'pass' . $string), rand(0 , 6), 6);
    }
}