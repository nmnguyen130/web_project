<?php

defined('ROOTPATH') or exit('Access Denied!');

spl_autoload_register(function ($classname) {
    $classname = explode("\\", $classname);
    $classname = end($classname);

    require_once $filename = "../app/models/" . ucfirst($classname) . ".php";
});

require_once 'config.php';
require_once 'functions.php';
require_once 'Database.php';
require_once 'Model.php';
require_once 'Controller.php';
require_once 'App.php';
