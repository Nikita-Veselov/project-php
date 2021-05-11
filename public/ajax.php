<?php

use app\services\Autoload;

include $_SERVER['DOCUMENT_ROOT'] . '/../services/Autoload.php';

spl_autoload_register(function($classname){
   (new Autoload)->loadClass($classname);
});


$req= json_decode(file_get_contents('php://input')); 

$reqLines = explode(",", $req);

foreach ($reqLines as $line) {
    $data = explode("=", $line);
    $result[$data[0]] = $data[1];
}


var_dump($result);
echo '<br/>';
var_dump($result['class']);
echo '<br/>';
