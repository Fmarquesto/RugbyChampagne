<?php
/**
 * Created by PhpStorm.
 * User: Fede Marquesto
 * Date: 8/7/2017
 * Time: 14:12
 */

namespace App\Auth;

use App\Models\User;

class Auth
{
    public function attempt($username, $password)
    {
        $user = User::where('username',$username)->first();
        if(!$user){
            return false;
        }
        if(password_verify($password, $user->password)){
            $_SESSION['user'] = $user->user_id;
            return true;
        }
        return false;
    }

    public function check()
    {
        return isset($_SESSION['user']);
    }

    public function user()
    {
        if($this->check()){
            return User::find($_SESSION['user']);
        }
        return null;
    }

    public function logout()
    {
        unset($_SESSION['user']);
    }
}