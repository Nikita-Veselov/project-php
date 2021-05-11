<?php

namespace app\services;

use app\base\Request;
use app\base\Session;

class Login 
{
    public function login (Session $session) {   
        $req = new Request;
        $userLogin = $req->post('login');
        $userCheck = (new Db)->queryOne('SELECT * FROM `users` WHERE `login` = ?', [$userLogin]);
        if (!is_null($userCheck)) {
                
            if (hash('md5', $req->post('password')) == $userCheck['password']) {
                $session->set('login', $userCheck['login']);
                $session->set('user', $userCheck['role']);
                $session->set('authorized', true);
                return 'valid';
            } else {
                return "invalid password";
            }
        } else {
            return "invalid login";
        }  
    } 
}
