<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

require_once 'vendor/autoload.php';

$configuration = [
    'settings' => [
        'displayErrorDetails' => true
    ]
];
$config = new \Slim\Container($configuration);

$middleware = function (Request $request, Response $response, $next): Response {
    $response->getBody()->write('First Middleware<br>');
    $response = $next($request, $response);
    $response->getBody()->write('<br>Second Middleware');
    return $response;
};

$app = new \Slim\App($config);

$app->get('/', function (Request $request, Response $response, array $args): Response {
    $response->getBody()->write('Hello, World!');
    return $response;
});

$app->group('/api', function () use ($app) {
    $app->get('/products[/{name}]', function (Request $request, Response $response, array $args): Response {
        $limit = $request->getQueryParams()['limit'] ?? 10;
        $name = $args['name'] ?? 'CPU';
        $response->getBody()->write("{$limit} products with the name {$name}.");
        return $response;
    });

    $app->post('/products', function (Request $request, Response $response, array $args): Response {
        $data = $request->getParsedBody();
        $name = $data['name'] ?? 'Mouse';
        $response->getBody()->write("Product: {$name}");
        return $response;
    });

    $app->put('/products', function (Request $request, Response $response, array $args): Response {
        $data = $request->getParsedBody();
        $name = $data['name'] ?? 'RAM';
        $response->getBody()->write("Product: {$name}");
        return $response;
    });

    $app->delete('/products', function (Request $request, Response $response, array $args): Response {
        $data = $request->getParsedBody();
        $name = $data['name'] ?? 'HD';
        $response->getBody()->write("Product: {$name}");
        return $response;
    });
})->add($middleware);

$app->run();
