<?php

namespace app\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use app\DAO\StoresDAO;
use app\Models\StoreModel;

final class StoreController
{
    public function getStores(Request $request, Response $response, array $args): Response
    {
        $storesDAO = new StoresDAO();
        $stores = $storesDAO->getAllStores();

        $response = $response->withJson($stores);
        return $response;
    }

    public function insertStore(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        $storesDAO = new StoresDAO();
        $store = new StoreModel();
        $store->setName($data['name'])
            ->setPhoneNumber($data['phone_number'])
            ->setAddress($data['address']);
        $storesDAO->insertStore($store);

        $response = $response->withJson([
            'message' => 'Store inserted successfully!'
        ]);
        return $response;
    }

    public function updateStore(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        $storesDAO = new StoresDAO();
        $store = new StoreModel();
        $store->setId((int) $data['id'])
            ->setName($data['name'])
            ->setPhoneNumber($data['phone_number'])
            ->setAddress($data['address']);
        $storesDAO->updateStore($store);

        $response = $response->withJson([
            'message' => 'Store updated successfully!'
        ]);
        return $response;
    }

    public function deleteStore(Request $request, Response $response, array $args): Response
    {
        $data = $request->getQueryParams();

        $storesDAO = new StoresDAO();
        $id = (int) $data['id'];
        $storesDAO->deleteStore($id);

        $response = $response->withJson([
            'message' => 'Store deleted successfully!'
        ]);
        return $response;
    }
}
