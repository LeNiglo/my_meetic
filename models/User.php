<?php

namespace Models;

use DB;
use Models\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillables = [
        'email', 'password', 'firstname', 'lastname', 'gender', 'birthday', 'registration_date', 'city', 'active',
    ];

    public static function auth($email, $password)
    {
        $db = DB::getInstance();
        $query = $db->prepare("SELECT * FROM users WHERE email = :email");
        $query->execute([
            'email' => $email,
        ]);

        $result = $query->fetch(\PDO::FETCH_OBJ);
        if (!$result) {
            return NULL;
        } elseif (!password_verify($password, $result->password)) {
            return NULL;
        } else {
            $user = new User();
            $user->id = $result->id;
            foreach ($user->getFillables() as $prop) {
                if (isset($result->{$prop})) {
                    $user->{$prop} = $result->{$prop};
                }
            }
            return $user;
        }
    }
}
