<?php

$namespaces = [
    'Rurushu' => 'framework',
    'App'     => 'app',
];

spl_autoload_register(function ($className) use ($namespaces) {
    $className = ltrim($className, '\\');
    $className = explode('\\', $className);
    $path = __DIR__ . '/../' . $namespaces[$className[0]];
    for ($i = 1; $i < count($className) - 2; $i++) {
        $path .= '/' . $className[$i];
    }
    include_once $path . '/' . $className[count($className)-1] . '.php';
});