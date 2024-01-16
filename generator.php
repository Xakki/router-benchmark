<?php

$apiDir = realpath(__DIR__ . '/../src/data/api') . 'generator.php/';

$fileArray = __DIR__ . '/../src/data/routesArray.php';
$fileMatch = __DIR__ . '/../src/data/routesMatch.php';
$fileAlto = __DIR__ . '/../src/data/routesAlto.php';

$dataArray = [];
$dataMatch = [];
$dataAlto = [];
for ($i = 0; $i < 1000; $i++) {
    $key = 'someurl' . $i;
    $path = $apiDir . $key . '.php';
    $dataArray['/'.$key] = $path;
    file_put_contents($path, "<?php return $i;");
    $dataMatch[] = '\'/'.$key.'\' => \''.$path.'\',';
    $dataAlto[] = PHP_EOL . '$router->map( \'GET\', \'/'.$key.'\', function() {
    return require \''.$path.'\';
});';
}

file_put_contents($fileArray,     "<?php return "
    .var_export($dataArray, true)
    .";");

file_put_contents($fileMatch,     '<?php return match($url) {' . PHP_EOL
    . implode(PHP_EOL, $dataMatch)
    . 'default => 0,' . PHP_EOL
    . PHP_EOL . '};');

file_put_contents($fileAlto,     '<?php' . PHP_EOL
    . implode(PHP_EOL, $dataAlto)
    );