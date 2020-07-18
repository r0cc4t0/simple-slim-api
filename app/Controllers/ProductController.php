<?php

namespace app\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use app\DAO\ProductsDAO;

final class ProductController
{
    public function getProducts(Request $request, Response $response, array $args): Response
    {
        $productsDAO = new ProductsDAO();
        $productsDAO->getAllProducts();
        return $response;
    }
}
