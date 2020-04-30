<?php

class Flash
{
    protected static function get($name)
    {
        return $_SESSION[$name];
    }

    protected static function exists($name)
    {
        return (isset($_SESSION[$name])) ? true : false;
    }

    protected static function delete($name)
    {
        if(self::exists($name))
            unset($_SESSION[$name]);
    }

    /**
     * string $name - ключ к сообщению
     * string $value - сообщение
     */
    public static function set($name, $value = '')
    {
       $_SESSION[$name] = $value;
    }

    /**
     * string $name - ключ к сообщению
     * return string - сообщение
     */
    public static function show($name)
    {
        if( self::exists($name) && self::get($name) !== '' )
        {
            $message = self::get($name);
            self::delete($name);
            return $message;
        }
    }
}