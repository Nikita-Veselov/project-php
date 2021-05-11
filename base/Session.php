<?php

namespace app\base;

class Session 
{
    public function __construct()
    {
        if (session_status()<2) {
            session_start();
        }
        if(is_null($_SESSION['login'])) {
                $_SESSION['login'] = 'guest';
        }
        if(is_null($_SESSION['user'])) {
                $_SESSION['user'] = 'guest';
        }
        if(is_null($_SESSION['authorized'])) {
                $_SESSION['authorized'] = false;
        }
    }

    public function get($key) 
    {
        return $_SESSION[$key];
    }

    public function set($key, $value)
    {
        return $_SESSION[$key] = $value;
    }

    public function notempty($key)
    {
        return empty($_SESSION[$key]);
    }

    public function exists($key) 
    {
        return isset($_SESSION[$key]); 
    }
}
