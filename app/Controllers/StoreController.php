<?php

namespace app\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use app\DAO\StoresDAO;

final class StoreController
{
    public function getStores(Request $request, Response $response, array $args): Response
    {
        $storesDAO = new StoresDAO();
        $storesDAO->getAllStores();
        return $response;
    }
}
