<?php

namespace app\base;

use app\controllers\RedirectController;
use app\controllers\RenderController ;

class Application 
{
    
    
    public $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function run() 
    {
        (new RedirectController)->compareUrl();
        
        (new RenderController($this->session))->render();
    }
}