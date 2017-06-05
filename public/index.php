<?php

include_once __DIR__ . '/../bootstrap/autoload.php';

$route = new \Rurushu\Route();

$route->get('/', function ($request) {
    return 'Hello World!';
});

$request = new \Rurushu\Request();

$route->parse($request);