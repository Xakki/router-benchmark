<?php

$startTime = microtime(true);

$url = $_GET['path'];
$routes = require __DIR__ . '/../src/routesArray.php';
$res = 0;
if (isset($routes[$url])) {
    $res = require $routes[$url];
    $code = 200;
}
else {
    $code = 404;
}

http_response_code($code);
header('Content-Type: application/json; charset=utf-8');

echo json_encode([
    'code' => $code,
    'result' => $res,
    'time9' => (int) ((microtime(true) - $startTime) * 1000000000),
    'mem' => memory_get_peak_usage(true),
]);