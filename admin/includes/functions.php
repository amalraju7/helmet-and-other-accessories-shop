<?php


function classAutoLoader($class){
$class = strtolower($class);
$path = "includes/{$class}.php";
if(file_exists($path)  && !class_exists($class))
{
    include($path);
}

}

spl_autoload_register('classAutoLoader');

function redirect($location){
    header("Location: {$location}");
}

?>