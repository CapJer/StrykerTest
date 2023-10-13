<?php
require("../bootstrap.php");

$dbConnection = (new provDatabase())->getConnection();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

$webController = new provWebController($dbConnection);


if (!$webController->ValidURL($uri[1])) {
    http_response_code(404);
    include('404.html');
    exit();
}

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$userId = null;
if (isset($uri[2])) {
    $userId = (int) $uri[2];
}

$requestMethod = $_SERVER["REQUEST_METHOD"];

$key = null;
if($_GET["ObjectKey"] != null) {
    $key = $_GET["ObjectKey"];
}

$token = null;
$headers = apache_request_headers();

foreach ($headers as $header => $value) {
    if($header === "Authorization")
    {
        $token = $value;
    }
}

if($token === "MySuperSecretToken") {
    $webController->HandleRequest($requestMethod, $key);
} else {
    http_response_code(401);
    exit();
}
