<?php

namespace Controllers;

use Controllers\Controller;
use Models\User;

class AuthController extends Controller
{
    public function login()
    {
        $email = '';
        if (isset($_SESSION['form_email'])) {
            $email = $_SESSION['form_email'];
            unset($_SESSION['form_email']);
        }

        return $this->view('login', [
            'title' => 'Login',
            'form' => [
                'email' => $email,
            ],
        ]);
    }

    public function post_login()
    {
        $user = User::auth($_POST['email'], $_POST['password']);
        if (is_null($user) || !$user->active) {
            $_SESSION['form_email'] = $_POST['email'];
            $_SESSION['error'] = 'login failed';
            return redirect('/auth/login', 401);
        } else {
            $_SESSION['current_user'] = $user->id;
            $_SESSION['success'] = 'login successfull';
            return redirect('/');
        }
    }

    public function register()
    {
        return $this->view('register', [
            'title' => 'Register',
        ]);
    }

    public function post_register()
    {

        if ($_POST['password'] !== $_POST['password_confirm']) {
            $_SESSION['error'] = 'passwords don\'t match';
            return redirect('/auth/register');
        }

        $user = new User();

        $user->email = $_POST['email'];
        $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user->firstname = $_POST['firstname'];
        $user->lastname = $_POST['lastname'];
        $user->birthday = "{$_POST['birth_year']}-{$_POST['birth_month']}-{$_POST['birth_day']}";

        try {
            $ret = $user->save();

            if ($ret === 1) {
                $_SESSION['success'] = 'register successfull, please login';
                return redirect('/auth/login');
            }
        } catch (\Exception $e) {

        }

        $_SESSION['error'] = 'register failed, please try again';
        return redirect('/auth/register');
    }

    public function logout()
    {
        unset($_SESSION['current_user']);
        $_SESSION['success'] = 'logout successfull';
        redirect('/auth/login');
    }
}
