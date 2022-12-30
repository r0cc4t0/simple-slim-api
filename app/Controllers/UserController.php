<?php

namespace app\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use app\DAO\UsersDAO;
use app\Models\UserModel;

final class UserController
{
    public function getUsers(Request $request, Response $response, array $args): Response
    {
        $usersDAO = new UsersDAO();
        $users = $usersDAO->getAllUsers();

        $response = $response->withJson($users);
        return $response;
    }

    public function getUser(Request $request, Response $response, array $args): Response
    {
        $data = $request->getQueryParams();
        $id = (int) $data['id'];
        
        $usersDAO = new UsersDAO();
        $user = $usersDAO->getUserById($id);

        $response = $response->withJson($user);
        return $response;
    }

    public function insertUser(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        $usersDAO = new UsersDAO();
        $user = new UserModel();
        $user->setName($data['name'])
            ->setEmail($data['email'])
            ->setPassword(password_hash($data['password'], PASSWORD_ARGON2I));
        $usersDAO->insertUser($user);

        $response = $response->withJson([
            'message' => 'User inserted successfully!'
        ]);
        return $response;
    }

    public function updateUser(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        $usersDAO = new UsersDAO();
        $user = new UserModel();
        $user->setId((int) $data['id'])
            ->setName($data['name'])
            ->setEmail($data['email'])
            ->setPassword(password_hash($data['password'], PASSWORD_ARGON2I));
        $usersDAO->updateUser($user);

        $response = $response->withJson([
            'message' => 'User updated successfully!'
        ]);
        return $response;
    }

    public function deleteUser(Request $request, Response $response, array $args): Response
    {
        $data = $request->getQueryParams();

        $usersDAO = new UsersDAO();
        $id = (int) $data['id'];
        $usersDAO->deleteUser($id);

        $response = $response->withJson([
            'message' => 'User deleted successfully!'
        ]);
        return $response;
    }
}
