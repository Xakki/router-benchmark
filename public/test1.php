<?php

defined('API_URL') || define('API_URL', 'nginx:80');
require_once __DIR__ . '/../src/bootstrap.php';

$max = (int) $_GET['count'] ?? 1000;
$url = 'http://'.API_URL.'/api_array.php';

$stats = runTest($max, $url);

$stats->name = 'array';

if (API_URL == 'nginx:80') {
    $stats->name .= '(FPM)';
} else {
    $stats->name .= '(RR)';
}

http_response_code(200);
header('Content-Type: application/json; charset=utf-8');

echo json_encode($stats);