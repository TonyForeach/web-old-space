<?php

error_reporting(E_ALL);
ini_set('ignore_repeated_errors', TRUE);
ini_set('display_errors', FALSE);
ini_set('log_errors', TRUE);
ini_set("error_log", "/home/ganaconos/web/ganaconos.com/public_html/admin/php_error.log");

require "global/config.php";
$controller = "";
$method = "";
$params = "";

$url = $_GET["url"] ?? "Index";
$arrayUrl = explode("/", $url);
if (isset($arrayUrl[0])) {
    $controller = $arrayUrl[0];
}
if (isset($arrayUrl[1])) {
    if ($arrayUrl[1] !='') {
        $method = $arrayUrl[1];
    }
}
if (isset($arrayUrl[2])) {
    if ($arrayUrl[2] !='') {
        $params = $arrayUrl[2];
    }
}
spl_autoload_register(function($class){
    //echo $class;
    if (file_exists(LBS.$class.".php")) {
        require LBS.$class.".php";
    }
});
require "Controllers/ErrorController.php";
$error = new ErrorController();
$controller = $controller.'Controller';
$controllersPath = "Controllers/".$controller.'.php';
if (file_exists($controllersPath)) {
    require $controllersPath;
    $controller = new $controller();
    if (isset($method)) {
        if (method_exists($controller,$method)) {
            if (isset($params)) { $controller->{$method}($params);} else {$controller->{$method}();}
        }else{
            if (method_exists($controller,$method ."index")) {$controller->Index();} else {$error->Error($url);}   
        }
    }
} else {
    $error->Error($url);
}
//echo $controller." ".$method." ".$params;
?>