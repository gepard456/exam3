<?php

class Flash
{
    protected static function get($key)
    {
        return $_SESSION[$key];
    }

    protected static function exists($key)
    {
        return (isset($_SESSION[$key])) ? true : false;
    }

    protected static function delete($key)
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