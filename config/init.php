<?php

//autoloader
spl_autoload_register(function($class_name){
    $file = "lib/" . $class_name . ".php";

    if(file_exists($file)){
        require $file;
        return;
    }
    echo "file: " . $file . "does not exist (comming from config/init.php)";
});


include "helpers/first-letter.php";