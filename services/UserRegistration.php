<?php

namespace app\services;

use app\base\Request;

class UserRegistration
{
    public function register()
    {
        $req = new Request;
        $db = new Db;
        $users = $db->queryAll('SELECT * FROM users');
        
        if ($req->post('user') == 'Register Me') 
        {
            $login = $req->post('login');
            $password = hash('md5',$req->post('password'));
            
            foreach ($users as $u) {
                if(is_integer(array_search($login, array($u['login']))))
                {
                    return 'user already exists';
                }
            }
            if ($req->post('password') != "")
            {  
                $db->execute(
                    'INSERT INTO users 
                    (login, password, role) 
                    VALUES (?, ?,"user")', 
                    [$login, $password]
            );
                return 'registered';
            } else 
            {
                return 'password missing!';
            }
        }
    }
}