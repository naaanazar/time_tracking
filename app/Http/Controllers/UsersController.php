<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Mail;
use App\Mail\mailCreateUser;

class UsersController extends Controller
{
    public function create(Request $request)
    {
       if(Input::all() == true) {
            $this->validation_create($request);
            $user = Input::all();

            if ( $user['users_team_id'] == '' ) {
                $user['users_team_id'] = 0;
            }

            $password = $this->password_generate();

            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => bcrypt($password),
                'employe' => $user['employe'],
                'users_team_id' => $user['users_team_id'],
                'team_name' => $user['team_name'],
                'hourly_rate' => $user['hourlyRate']
            ]);

            Mail::to($user['email'])->send(new mailCreateUser($user['name'], $password, $user['email']));

            return redirect('/user/all');
        }

        $teams = DB::table('teams')->get();

        return view('auth.registration', compact('teams'));
    }
    /*
     * update user
     * $id - user id
     * */
    public function update(Request $request, $id = false)
    {
        if(Input::all() == true && User::where('id', '=', $id) == true) {
            $this->validation_update($request);

            $user = Input::all();

            User::where('id', '=', $id)->update([
                'name' => $user['name'],
                'employe' => $user['employe'],
                'team_name' => $user['team_name'],
                'hourly_rate' => $user['hourlyRate']
            ]);

            return redirect('/user/all');
        }

        $user = DB::table('users')->where('id', '=', $id)->first();
        $teams = DB::table('teams')->get();

        return view('auth.update_user', compact('user', 'teams'));
    }
    /*
     * delete user
     * $id - user id
     * */
    public function delete($id)
    {
        User::where('id', '=', $id)->delete();

        return redirect('/user/all');
    }

    protected function validation_create ($request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:30',
            'email' => 'required|unique:users|email',
            'employe' => 'required|max:20',
            'hourlyRate' => 'numeric'
        ]);
    }

    protected function validation_update ($request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:30',
            'employe' => 'required|max:20',
            'hourlyRate' => 'numeric'
        ]);
    }

    protected function password_generate()
    {
        $chars = 'qSwDerfRtyuiopasdfghjklmnbvcxz';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < 10; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }

        return substr(md5(rand(1, 10000) . 'pass' . $string), rand(0 , 6), 6);
    }
}