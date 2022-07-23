<?php

require_once 'bootstrap.php';
use App\Controller\UserController;
use App\System\ApiResponse;

// setting header

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if (!isset($_SERVER['REQUEST_METHOD']) || !isset($_SERVER['REQUEST_URI'])) {
    ApiResponse::code(400);
    exit();
}

$requestMethod = $_SERVER["REQUEST_METHOD"];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );
// var_dump($uri);


// all of our endpoints start with either /student or /manager
// everything else results in a 404 Not Found
$service = $uri[3];
if ($service !== 'student' && $service !== 'manager') {
    ApiResponse::code(404);
    exit();
}

// the user id is, of course, optional and must be a number:
$userId = null;
if (isset($uri[4])) {
    $userId = (int) $uri[4];
}


// pass the request method and user ID to the UserController and process the HTTP request:
$controller = new UserController($requestMethod, $service,  $userId);
$controller->processRequest();

