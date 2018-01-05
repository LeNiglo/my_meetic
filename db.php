<?php

class DB
{
    private static $instance = NULL;

    private function __construct()
    {

    }

    private function __clone()
    {

    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            self::$instance = new PDO("mysql:host=" . config('DB_HOST') . ";port=" . config('DB_PORT') . ";dbname=" . config('DB_DATABASE'), config('DB_USERNAME'), config('DB_PASSWORD'), $pdo_options);
        }
        return self::$instance;
    }
}
