<?php

function dd(...$args)
{
    echo '<pre>';
    var_dump($args);
    echo '</pre>';
    die;
}

function redirect($url = '/', $http_code = 200)
{
    ob_start();
    http_response_code($http_code);
    header("Location: $url");
    ob_end_flush();
    die;
}

function auth_check()
{
    return isset($_SESSION['current_user']) && !empty($_SESSION['current_user']);
}

function auth_id()
{
    return $_SESSION['current_user'];
}

function auth_user()
{
    $user = new \Models\User();
    $found = $user->find($_SESSION['current_user']);
    return $found;
}
