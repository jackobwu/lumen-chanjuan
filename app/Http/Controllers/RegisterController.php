<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function __construct()
    {
        //
    }

    public function register(Request $request) {
        $username = $request->get('username');
        $email = $request->get('email');
        $password = $request->get('password');
        $password_confirm = $request->get('password_confirm');

        if ($password == $password_confirm) {
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
            $query = "INSERT INTO users (name, email, password, age, gender) 
                                    VALUES ('$username', '$email', '$password_hash', 35, 1)";
            app('db')->insert($query);
            return "success";
        }
    }

    public function login(Request $request) {
        $email = $request->get('email');
        $password = $request->get('password');
        $password_hash = DB::table('users')->where('email',"$email")->value('password');
        if (password_verify($password, $password_hash)) {
            return "logined";
        } else {
            return "not logined";
        }
    }
}
