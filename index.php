<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('BASE_PATH', realpath(dirname(__FILE__)));

function my_autoloader($class)
{
    $parts = explode('\\', $class);
    if (strtoupper($parts[0]) === 'APP') {
        array_shift($parts);
    }
    $filename = BASE_PATH . DIRECTORY_SEPARATOR . 'src'
        . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $parts) . '.php';
    include($filename);
}

spl_autoload_register('my_autoloader');

use App\Core\Request;
use App\Core\Application;

$request = new Request();
$app = new Application();

$app->run($request);