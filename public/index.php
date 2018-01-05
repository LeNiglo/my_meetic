<?php

session_start();
require_once('../autoload.php');
require_once('../config.php');
require_once('../helpers.php');
require_once('../csrf.php');

$_request_uri = $_SERVER['REQUEST_URI'];
$_request_uri = strtok($_request_uri, '?');
$_request_uri = strtok($_request_uri, '#');

$_query_string = explode('/', trim($_request_uri, '/'));

$_controller = isset($_query_string[0]) && !empty($_query_string[0]) ? $_query_string[0] : 'home';
$_action = isset($_query_string[1]) && !empty($_query_string[1]) ? $_query_string[1] : 'index';

$controller_class = "Controllers\\{$_controller}Controller";
$controller = NULL;
if (class_exists($controller_class)) {
    $controller = new $controller_class();
} else {
    // TODO instead of die => view 404
    die("Controller '{$controller_class}' not found.");
}

if (method_exists($controller, $_action)) {
    $controller->{$_action}();
} else {
    // TODO instead of die => view 404
    die("Method '{$_action}' not found in '{$controller_class}'.");
}
