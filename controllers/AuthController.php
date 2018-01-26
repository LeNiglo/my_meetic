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
        ], 'layout_full');
    }

    public function post_login()
    {
        $user = User::auth($_POST['email'], $_POST['password']);
        if (is_null($user)) {
            $_SESSION['form_email'] = $_POST['email'];
            $_SESSION['error'] = 'login failed';
            return redirect('/auth/login', 401);
        } elseif (!$user->active) {
            $_SESSION['form_email'] = $_POST['email'];
            $_SESSION['error'] = 'account disabled';
            return redirect('/auth/login', 401);
        } else {
            $_SESSION['current_user'] = $user->id;
            $_SESSION['success'] = 'login successfull';
            return redirect('/');
        }
    }

    public function register()
    {
        $email = '';
        $firstname = '';
        $lastname = '';
        $gender = '';
        $city = '';
        $birth_year = '';
        $birth_month = '';
        $birth_day = '';

        if (isset($_SESSION['form_email'])) {
            $email = $_SESSION['form_email'];
            unset($_SESSION['form_email']);
        }
        if (isset($_SESSION['form_firstname'])) {
            $firstname = $_SESSION['form_firstname'];
            unset($_SESSION['form_firstname']);
        }
        if (isset($_SESSION['form_lastname'])) {
            $lastname = $_SESSION['form_lastname'];
            unset($_SESSION['form_lastname']);
        }
        if (isset($_SESSION['form_gender'])) {
            $gender = $_SESSION['form_gender'];
            unset($_SESSION['form_gender']);
        }
        if (isset($_SESSION['form_city'])) {
            $city = $_SESSION['form_city'];
            unset($_SESSION['form_city']);
        }
        if (isset($_SESSION['form_birth_year'])) {
            $birth_year = $_SESSION['form_birth_year'];
            unset($_SESSION['form_birth_year']);
        }
        if (isset($_SESSION['form_birth_month'])) {
            $birth_month = $_SESSION['form_birth_month'];
            unset($_SESSION['form_birth_month']);
        }
        if (isset($_SESSION['form_birth_day'])) {
            $birth_day = $_SESSION['form_birth_day'];
            unset($_SESSION['form_birth_day']);
        }


        return $this->view('register', [
            'title' => 'Register',
            'form' => [
                'email' => $email,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'gender' => $gender,
                'city' => $city,
                'birth_year' => $birth_year,
                'birth_month' => $birth_month,
                'birth_day' => $birth_day,
            ],
        ], 'layout_full');
    }

    public function post_register()
    {

        if ($_POST['password'] !== $_POST['password_confirm']) {
            $_SESSION['form_email'] = $_POST['email'];
            $_SESSION['form_firstname'] = $_POST['firstname'];
            $_SESSION['form_lastname'] = $_POST['lastname'];
            $_SESSION['form_gender'] = $_POST['gender'];
            $_SESSION['form_city'] = $_POST['city'];
            $_SESSION['form_birth_year'] = $_POST['birth_year'];
            $_SESSION['form_birth_month'] = $_POST['birth_month'];
            $_SESSION['form_birth_day'] = $_POST['birth_day'];
            $_SESSION['error'] = 'passwords don\'t match';
            return redirect('/auth/register');
        }

        $user = new User();

        $user->email = $_POST['email'];
        $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user->firstname = $_POST['firstname'];
        $user->lastname = $_POST['lastname'];
        $user->gender = $_POST['gender'];
        $user->city = $_POST['city'];
        $user->birthday = "{$_POST['birth_year']}-{$_POST['birth_month']}-{$_POST['birth_day']}";

        try {
            $ret = $user->save();

            if ($ret === 1) {
                $_SESSION['success'] = 'register successfull, please login';
                return redirect('/auth/login');
            }
        } catch (\Exception $ignore) { unset($ignore); }
        $_SESSION['form_email'] = $_POST['email'];
        $_SESSION['form_firstname'] = $_POST['firstname'];
        $_SESSION['form_lastname'] = $_POST['lastname'];
        $_SESSION['form_gender'] = $_POST['gender'];
        $_SESSION['form_city'] = $_POST['city'];
        $_SESSION['form_birth_year'] = $_POST['birth_year'];
        $_SESSION['form_birth_month'] = $_POST['birth_month'];
        $_SESSION['form_birth_day'] = $_POST['birth_day'];
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
