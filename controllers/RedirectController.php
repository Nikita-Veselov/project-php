<?php
namespace app\controllers;

use app\base\Request;
use app\services\Db;

class RedirectController extends Controller
{    
    public $req;
    public $url;

    public function __construct()
    {
        $this->req = new Request;
        $this->host = $this->req->server('HTTP_HOST');
        $this->uri =  $this->req->server('REQUEST_URI');

        if($this->uri == "/" ){
            $this->url = "http://" . $this->host;
        } else {
            $this->url = "http://" . $this->host . $this->uri;
        }
    }

    public function compareUrl() {
        $urlDb = $this->findUrl();
        if($this->url == $urlDb['outgoing_url']) {
            
           $this->registerClick();

            $urlForRedirect = $urlDb['incoming_url'];
            
            if (!is_null($urlForRedirect)){

                header("Location: $urlForRedirect"); 
                exit; 
            }
        } else {
            return false;
        }
    }

    public function findUrl() {
        $sql = 'SELECT * FROM `url` WHERE `outgoing_url` = ?';
        $db = (new Db)->queryOne($sql, [$this->url]);
        return $db;
    }

    public function registerClick() {
        $sql = 'UPDATE `url` SET clicks = clicks + 1 WHERE `outgoing_url` = ?';
        
        $db = (new Db);
        $db->execute($sql, [$this->url]);

        if (isset($_SERVER['HTTP_REFERER'])) {
            $urlFrom = $_SERVER['HTTP_REFERER'];
        } else {
            $urlFrom = $_SERVER['HTTP_HOST'];
        }
        
        date_default_timezone_set("Europe/Moscow");
        $urlClickDate = date("d.m.Y");

        $sql2 = 'INSERT INTO clicks (link, click_url, click_date) VALUES (?, ?, ?)';
        
        $db->execute($sql2, [$this->url, $urlFrom, $urlClickDate]);
    }
}