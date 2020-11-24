<?php
session_start();
spl_autoload_register(function($class) {
    $fileName = $class . '.php';
    if (file_exists('controllers/'.$fileName)) require 'controllers/'.$fileName;
    if (file_exists('models/'.$fileName)) require 'models/'.$fileName;
    if (file_exists('views/'.$fileName)) require 'views/'.$fileName;
    if (file_exists($fileName)) require $fileName;
});

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    if (preg_match("/admin\/login\/?$/", $uri)){
        AdminController::login();
    }
    elseif (preg_match("/admin\/logout\/?$/", $uri)){
        AdminController::logout();
        TaskController::add();
    }
    elseif (preg_match("/task\/add\/?$/", $uri)){
        TaskController::add();
    }
    elseif (preg_match("/task\/delete\/([^\/]*)\/?$/", $uri, $params)){
        TaskController::delete($params[1]);
    }
    elseif (preg_match("/task\/edit\/([^\/]*)\/?$/", $uri, $params)){
        TaskController::edit($params[1]);
    }
    else{
      MainController::index();
    }
