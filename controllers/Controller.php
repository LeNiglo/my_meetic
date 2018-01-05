<?php

namespace Controllers;

class Controller
{
    function __construct()
    {

    }

    protected function view($view, $variables = [], $layout = 'layout')
    {
        extract($variables);
        if (file_exists("../views/{$view}.php") && file_exists("../views/{$layout}.php")) {
            $__view_name = "../views/{$view}.php";
            include("../views/{$layout}.php");
        } else {
            die("View '$view' not found, using Layout '$layout'.");
        }
    }
}
