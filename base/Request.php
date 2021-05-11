<?php

namespace app\base;

class Request
{    
    public function get ($name) 
    {
        return $_GET[$name];
    }   
    public function post ($name) 
    {
        return $_POST[$name];
    }
    
    public function param ($name) 
    {
        return $_REQUEST[$name];
    }

    public function server ($name)
    {
        return $_SERVER[$name];
    }
    public function isPost() 
    {
        return $this->method == "POST";
    }
    public function isGet() 
    {
        return $this->method == "GET";
    }
}