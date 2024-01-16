<?php

require __DIR__ . '/vendor/autoload.php';

function recursiveRequire(string $path): void
{
    $directory = new RecursiveDirectoryIterator($path);
    $fullTree = new RecursiveIteratorIterator($directory);
    $phpFiles = new RegexIterator($fullTree, '/.+((?<!Test)+\.php$)/i', RecursiveRegexIterator::GET_MATCH);

    foreach ($phpFiles as $key => $file) {
        require_once $file[0];
    }
}

require_once __DIR__ . '/src/bootstrap.php';
recursiveRequire(__DIR__ . '/src/api');
//recursiveRequire(__DIR__ . '/vendor');
//recursiveRequire(__DIR__ . '/public');