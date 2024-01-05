<?php
use Core\Framework\Routing\Router;

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH.'/vendor/autoload.php';


use Core\Framework\Http\Request;
use Core\Framework\Http\KernelHttp;

$router = new Router();
$kernel = new KernelHttp($router);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);

$response->send();
