<?php

$startTime = microtime(true);

$url = $_GET['path'];
$route = require __DIR__ . '/../src/routesMatch.php';
$res = 0;
if ($route) {
    $res = require $route;
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