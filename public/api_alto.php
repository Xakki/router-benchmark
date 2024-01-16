<?php

$startTime = microtime(true);

require_once __DIR__ . '/../vendor/autoload.php';

$router = new AltoRouter();

require __DIR__ . '/../src/routesAlto.php';

$match = $router->match($_GET['path']);
$res = 0;
if (is_array($match) && is_callable( $match['target'] )) {
    $res = call_user_func_array( $match['target'], $match['params'] );
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