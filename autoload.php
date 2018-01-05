<?php

// function __autoload($str) {
//     $require = NULL;
//     $str = ucfirst($str);
//
//     if (file_exists("controllers/{$str}Controller.php")) {
//         $require = "controllers/{$str}Controller.php";
//     } elseif (file_exists("models/{$str}.php")) {
//         $require = "models/{$str}.php";
//     }
//
//     if (is_null($require)) {
//         return false;
//     } else {
//         require_once($require);
//         return true;
//     }
// }


class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class) {
            $file = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
            if (file_exists($file)) {
                require $file;
                return true;
            }
            return false;
        });
    }
}
Autoloader::register();
