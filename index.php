<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
$routes = explode('/', $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
define('PROTOCOL', $routes[0]);
define('URL_BASE','/messenger');
define('START_POSITION',2);
ini_set('display_errors', 0);
require_once 'bizz/bootstrap.php';
