<?php

namespace app\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class ProductController
{
    public function getProducts(Request $request, Response $response, array $args): Response
    {
        // $response->getBody()->write('Hello, World!');
        $response = $response
            ->withJson([
                'message' => 'Hello, World!'
            ])
            ->withHeader(
                'Content-Type',
                'application/json; charset=utf-8'
            );
        return $response;
    }
}
