<?php

require_once 'vendor/autoload.php';

$app = new \Slim\App();

$app->get('/', function ($request, $response, $args) {
    return $response->getBody()->write('Hello, World!');
});

$app->run();
