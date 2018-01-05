<?php

namespace Controllers;

use Controllers\Controller;
use Models\User;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        $user = NULL;
        if (auth_check()) {
            $user = auth_user();
        }

        return $this->view('home', [
            'title' => 'Home',
            'user' => $user,
        ]);
    }

    public function search()
    {
        $user = NULL;
        if (auth_check()) {
            $user = auth_user();
        }

        $results = [];
        $sql = "SELECT * FROM users WHERE active = 1";
        $bindings = [];

        if (isset($_POST['age']) && !empty($_POST['age'])) {
            $age1 = explode('/', $_POST['age'])[1];
            $age2 = explode('/', $_POST['age'])[0];

            if ($age1 == 0) {
                $sql .= " AND birthday < :date";
                $bindings['date'] = date('Y-m-d', strtotime("-$age2 year", time()));
            } else {
                $sql .= " AND birthday BETWEEN :date1 AND :date2";
                $bindings['date1'] = date('Y-m-d', strtotime("-$age1 year", time()));
                $bindings['date2'] = date('Y-m-d', strtotime("-$age2 year", time()));
            }
        }

        if (isset($_POST['gender']) && !empty($_POST['gender'])) {
            $sql .= " AND gender = :gender";
            $bindings['gender'] = $_POST['gender'];
        }

        if (isset($_POST['city']) && !empty($_POST['city'])) {
            $sql .= " AND city = :city";
            $bindings['city'] = strtolower($_POST['city']);
        }

        $query = DB::getInstance()->prepare($sql);
        $query->execute($bindings);

        $results = $query->fetchAll(\PDO::FETCH_OBJ);

        return $this->view('search', [
            'search' => [
                'age' => isset($_POST['age']) ? $_POST['age'] : NULL,
                'gender' => isset($_POST['gender']) ? $_POST['gender'] : NULL,
                'city' => isset($_POST['city']) ? $_POST['city'] : NULL,
            ],
            'title' => 'Match Some1',
            'user' => $user,
            'results' => $results,
        ]);
    }
}
