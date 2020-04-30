<?php

class Router{

    protected static $path404;

    /**
     * string $path - пусть к файлу с ошибкой 404
     */
    public static function setPath404($path)
    {
        self::$path404 = $path;
    }

    /**
     * array $routes - массив соответствий адресов и путей подключаемых файлов
     */
    public static function execute($routes)
    {
        if(array_key_exists($_SERVER['REQUEST_URI'], $routes))
            include $routes[$_SERVER['REQUEST_URI']];
        else
            include self::$path404;
    }
}