<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

require_once 'vendor/autoload.php';

$app = new \Slim\App();

$app->get('/', function (Request $request, Response $response, array $args): Response {
    $response->getBody()->write('Hello, World!');
    return $response;
});

$app->get('/products[/{name}]', function (Request $request, Response $response, array $args): Response {
    $limit = $request->getQueryParams()['limit'] ?? 10;
    $name = $args['name'] ?? 'CPU';
    $response->getBody()->write("{$limit} products with the name {$name}.");
    return $response;
});

$app->run();
