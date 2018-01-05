<?php

namespace Controllers;

use Controllers\Controller;
use Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = NULL;
        if (isset($_GET['id'])) {
            $user = new \Models\User();
            $user = $user->find(intval($_GET['id']));
            if (is_null($user)) {
                return $this->view('profile', [
                    'title' => 'User not found',
                    'user' => $user,
                ]);
            }
        } else if (auth_check()) {
            $user = auth_user();
        }

        return $this->view('profile', [
            'title' => "Profile of {$user->firstname}",
            'user' => $user,
        ]);
    }

    public function update()
    {
        $user = auth_user();
        if (!isset($_POST['old_password']) || !isset($_POST['password']) || !isset($_POST['password_confirm'])) {
            $_SESSION['error'] = 'missing field';
            return redirect('/profile');
        } else if (!password_verify($_POST['old_password'], $user->password)) {
            $_SESSION['error'] = 'wrong password';
            return redirect('/profile');
        } else if ($_POST['password'] != $_POST['password_confirm']) {
            $_SESSION['error'] = 'passwords don\'t match';
            return redirect('/profile');
        } else {
            $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $user->save();
            $_SESSION['success'] = 'password updated successfully';
            return redirect('/profile');
        }
    }

    public function disable()
    {
        $user = auth_user();
        $user->active = 0;
        $user->save();
        return redirect('/auth/logout');
    }
}
