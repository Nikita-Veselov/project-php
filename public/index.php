<?php

use app\base\Application;
use app\base\Session;
use app\services\Autoload;

include $_SERVER['DOCUMENT_ROOT'] . '/../services/Autoload.php';

spl_autoload_register(function($classname){
   (new Autoload)->loadClass($classname);
});

$session = new Session();

$app = new Application($session);

$app->run();

?>

<!-- TESTING SECTION -->
<!-- 
<form id="loginform">
   <input type="text" name="login" id="login">
   <input type="text" name="password" id="password">
   <input type="submit" id="submit" value="Submit" onclick="loginFunc('loginform')"/>
</form>

<form id="registerform">
   <input type="text" name="login" id="login2">
   <input type="text" name="password" id="password2">
   <input type="submit" id="submit" value="Submit" onclick="registerFunc('registerform')"/>
</form>

<div type="text" id="msg"></div>
<div type="text" id="msg2"></div>
<div type="text" id="msg3"></div> -->

<!-- TESTING SECTION -->