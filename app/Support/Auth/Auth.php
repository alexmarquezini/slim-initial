<?php 

namespace SlimInitial\Support\Auth;

use SlimInitial\Models\User;

class Auth
{
    public function user()
    {
        if(isset($_SESSION['user'])) {
            return User::find($_SESSION['user']);
        }
    }

    public function check()
    {
        return isset($_SESSION['user']);
    }

    public function attempt($email, $password)
    {
        $user = User::where('email', $email)->first();

        if(!$user) {
            return false;
        }

        if(password_verify($password, $user->password)) {
            $_SESSION['user'] = $user->id;
            return true;
        }

        return false;
    }

    public function logout()
    {
        unset($_SESSION['user']);
    }
}