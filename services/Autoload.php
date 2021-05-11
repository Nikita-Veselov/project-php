<?php

namespace app\services;

class Autoload 
{
    private $fileExtension = '.php';

    public function loadClass($classname)
    {
        //var_dump($classname);
        $classname = str_replace('app\\', __DIR__ . "/../", $classname);
        
        //var_dump($classname);
            
            $filename = str_replace('\\', '/', $classname . $this->fileExtension);
            
            //var_dump($filename);
        if (file_exists($filename)) {
                //var_dump($filename);
                
                require $filename;
                return true;
        }
            
        //var_dump('kekw2');
        return false;
       
      
    }
}
