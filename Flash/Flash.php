<?php

class Flash
{
    private function __construct() {}
    
    private function __clone() {}

    private static function get($key)
    {
        return $_SESSION[$key];
    }

    private static function exists($key)
    {
        return (isset($_SESSION[$key])) ? true : false;
    }

    private static function delete($key)
    {
        if(self::exists($key))
            unset($_SESSION[$key]);
    }

    /**
     * string $key - ключ к сообщению
     * string $value - сообщение
     */
    public static function set($key, $value = '')
    {
       $_SESSION[$key] = $value;
    }

    /**
     * string $key - ключ к сообщению
     * return string - сообщение
     */
    public static function show($key)
    {
        if( self::exists($key) && self::get($key) !== '' )
        {
            $message = self::get($key);
            self::delete($key);
            return $message;
        }
    }
}