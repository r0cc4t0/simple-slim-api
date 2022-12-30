<?php

namespace app\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use app\DAO\ProductsDAO;
use app\Models\ProductModel;

final class ProductController
{
    public function getProducts(Request $request, Response $response, array $args): Response
    {
        $productsDAO = new ProductsDAO();
        $products = $productsDAO->getAllProducts();

        $response = $response->withJson($products);
        return $response;
    }

    public function getProduct(Request $request, Response $response, array $args): Response
    {
        $data = $request->getQueryParams();
        $id = (int) $data['id'];
        
        $productsDAO = new ProductsDAO();
        $product = $productsDAO->getProductById($id);

        $response = $response->withJson($product);
        return $response;
    }

    public function insertProduct(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        $productsDAO = new ProductsDAO();
        $product = new ProductModel();
        $product->setStoreId((int) $data['store_id'])
            ->setName($data['name'])
            ->setPrice((float) $data['price'])
            ->setQuantity((int) $data['quantity']);
        $productsDAO->insertProduct($product);

        $response = $response->withJson([
            'message' => 'Product inserted successfully!'
        ]);
        return $response;
    }

    public function updateProduct(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        $productsDAO = new ProductsDAO();
        $product = new ProductModel();
        $product->setId((int) $data['id'])
            ->setStoreId((int) $data['store_id'])
            ->setName($data['name'])
            ->setPrice((float) $data['price'])
            ->setQuantity((int) $data['quantity']);
        $productsDAO->updateProduct($product);

        $response = $response->withJson([
            'message' => 'Product updated successfully!'
        ]);
        return $response;
    }

    public function deleteProduct(Request $request, Response $response, array $args): Response
    {
        $data = $request->getQueryParams();

        $productsDAO = new ProductsDAO();
        $id = (int) $data['id'];
        $productsDAO->deleteProduct($id);

        $response = $response->withJson([
            'message' => 'Product deleted successfully!'
        ]);
        return $response;
    }
}
