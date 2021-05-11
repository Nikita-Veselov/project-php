<?php

namespace app\controllers;

use app\base\Request;
use app\base\Session;
use app\services\Db;
use app\services\Login;
use app\services\Render;
use app\services\UserRegistration;

class RenderController
{
    public $session;

    public $buttons = [];

    public function __construct(Session $session)
    {
        $this->session = $session;
        $this->render = new Render;
    }

    public function render() 
    {
        $reqUser = (new Request)->post('user');
        if ($reqUser == null) 
        {
            $reqUser = 'Nothing pressed';
        }

        if ($reqUser == 'Log In') 
        {
            $this->renderLogin($reqUser);
            $this->renderIndex();
        } elseif ($reqUser == 'Register') 
        {
            $this->renderRegister($reqUser);
            $this->renderIndex();
        } elseif ($reqUser == 'Account') {
            $this->renderPage($this->session->get('user')); 
        } else {
           $this->renderIndex(); 
        }
    }

    public function renderIndex () {
        $reqUser = (new Request)->post('user');

        $auth = $this->session->get('authorized');

        if ($auth)
        {
            $buttons = ['Log Out', 'Account'];
        } else 
        {
            $buttons = ['Log In', 'Register'];
        }

        if ($reqUser == 'Log Out') 
        {
            $this->session->set('login', 'guest');
            $this->session->set('user', 'guest');
            $this->session->set('authorized', false);
            $buttons = ['Log In', 'Register'];
        } 

        if ($reqUser == 'Log Me') 
        {
            $login = (new Login)->login($this->session);
            if($login === 'valid')
            {
                $buttons = ['Log Out', 'Account'];
            } else {
                $this->renderLogin($login);
            }
        } 

        if ($reqUser == 'Register Me') 
        {
            $reg = (new UserRegistration)->register();
            if ($reg != 'registered') {
                $this->renderRegister($reg);
            } 
        }
        
        $reqUrl = (new Request)->post('url');
        $urlManager = new UrlController;
        echo $this->render->render('index', [
            'button1' => $buttons[0],
            'button2' => $buttons[1],
            'outputLink' => $urlManager->newUrl(),
            'linkValidation' => $urlManager->postUrlCheck(),
            'insertedUrl' =>  $reqUrl
            ]);
    }

    public function renderLogin($message) {
        echo $this->render->render('login', ['login_php' => $message]); 
    }

    public function renderRegister($message) {
        echo $this->render->render('register', ['register_php' => $message]); 
    }

    public function renderPage($user) {
        $login = $this->session->get('login');

        echo $this->render->render($user, [
            'userName' => $login,
            'userLinks' => $this->userLinksRender(),
            ]);
    }

    public function userLinksRender() 
    {
        $login = $this->session->get('login');

        $sql = 'SELECT * FROM `url` WHERE `belong_to` = ?';
        $linksFromDb = (new Db)->queryAll($sql, [$login]);

        $linksString = '';
        foreach($linksFromDb as $row) {
            $linksString .= 
            '<div class="link">' . 
                '<div class="link-date">' . $row['creation_date'] . '</div>' .  
                '<div class="link-name">' . $row['incoming_url'] . '</div>' .
                '<a href="' . $row['outgoing_url'] . '">' . '<div class="link-created">' . $row['outgoing_url'] . '</div>' . '</a>' . 
                '<div class="link-clicks">' . $row['clicks'] . '</div>' .
            '</div>';
        }
        return $linksString;
    }
}