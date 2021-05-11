<?php

namespace app\controllers;

use app\base\Request;
use app\base\Session;
use app\services\Db;
use app\services\RandomString;

class UrlController 
{
    public $request;
    public $db;
    public $session;

    public function __construct()
    {
        $this->request = new Request;
        $this->db = new Db;
        $this->session = new Session;
    }

    public function postUrlCheck() 
    {
        $url =  $this->request->post('url');

        if (!is_null($url)){
            if (!empty($url)) {
                if ($url = $this->urlCorrectnessCheck($url)){
                    if ($this->urlExistenceCheck($url))
                    {
                        $answer = "Server answer";
                        return $answer;
                        
                    } else {
                        $answer = "Server don't answer";
                        return $answer;
                    }
                } else {
                    $answer = "Incorrect link";  
                    return $answer;
                } 
                return false;
            }
        }
    }

    public function urlCorrectnessCheck($url) 
    {
        if(preg_match("@^http:/@i", $url)) 
        {
            $url = preg_replace("@(http://)+@i", 'http://', $url);

        } else if (preg_match("@^https://@i", $url)) 
            {
            $url = preg_replace("@(https://)+@i", 'https://', $url);

        } else  
            {
            $url = 'http://' . $url;
        }
       
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            return false;

        } else {
            return $url;
        } 
    }

    public function urlExistenceCheck($url) 
    {
        $url_c = parse_url($url);
        if (!empty($url_c['host']) and checkdnsrr($url_c['host']))
        {
            $ans = @get_headers($url);
            if ($ans && strpos($ans[0], '200'))
            {
                return true;
            }
        }
        return false;
    }

    public function newUrl()
    {
        $reqUrl =  $this->request->post('url');
        $reqUrl = strtolower($reqUrl);
        if (!is_null($reqUrl)){
            if (!empty($reqUrl)) {
                $host = $this->request->server('HTTP_HOST');
                $uri =  $this->request->server('REQUEST_URI');

                if($uri == "/" ){
                    $url = "http://" . $host;
                } else {
                    $url = "http://" . $host . $uri;
                }

                $generatedString = (new RandomString)->generateString();
                $url =   $this->request->server('HTTP_HOST');

                $outputString = "http://" . $url . "/" . $generatedString;

                $reqUrlToDb = "http://" . $reqUrl;
                $outUrlToDb = $outputString;
                
                
                $curUser = $this->session->get('login');

                $checkUrl = $this->db->queryOne('SELECT * FROM `url` WHERE `incoming_url` = ? AND `belong_to` = ?', [$reqUrlToDb, $curUser]);
                if (is_null($checkUrl)) {
                    $this->postToDb($reqUrlToDb, $outUrlToDb);

                    return  $outputString;
                } else {
                    return $checkUrl['outgoing_url'];
                }
                
            }
        }    
    }
    
    public function postToDb($insertedUrl, $outputUrl)
    {
        $user = $this->session->get('login');
        date_default_timezone_set("Europe/Moscow");
        $currentDate = date("d.m.Y");

        $sql = 'INSERT INTO `url`
        (incoming_url, outgoing_url, belong_to, creation_date) 
        VALUES (?, ?, ?, ?)';

        $this->db->execute($sql,[$insertedUrl, $outputUrl, $user, $currentDate]);
    }

}