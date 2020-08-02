<?php

namespace app\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use app\Models\TokenModel;
use app\DAO\{UsersDAO, TokensDAO};
use Firebase\JWT\JWT;

final class AuthController
{
    public function login(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $email = $data['email'];
        $password = $data['password'];
        $expire_date = $data['expire_date'];
        $is_active = 1;

        $usersDAO = new UsersDAO();
        $user = $usersDAO->getUserByEmail($email);

        if (is_null($user)) {
            return $response->withStatus(401);
        }
        if (!password_verify($password, $user->getPassword())) {
            return $response->withStatus(401);
        }

        $tokenPayload = [
            'sub' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'expired_at' => $expire_date,
            'active' => $is_active
        ];
        $token = JWT::encode($tokenPayload, getenv('JWT_SECRET_KEY'));

        $refreshTokenPayload = [
            'email' => $user->getEmail(),
            'random' => uniqid()
        ];
        $refreshToken = JWT::encode($refreshTokenPayload, getenv('JWT_SECRET_KEY'));

        $tokenModel = new TokenModel();
        $tokenModel->setUserId($user->getId())
            ->setToken($token)
            ->setRefreshToken($refreshToken)
            ->setExpiredAt($expire_date)
            ->setActive($is_active);

        $tokensDAO = new TokensDAO();
        $tokensDAO->createToken($tokenModel);

        $response = $response->withJson([
            "token" => $token,
            "refresh_token" => $refreshToken
        ]);
        return $response;
    }

    public function refreshToken(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $refreshToken = $data['refresh_token'];
        $expire_date = $data['expire_date'];
        $is_active = 1;

        $refreshTokenDecoded = JWT::decode($refreshToken, getenv('JWT_SECRET_KEY'), ['HS256']);

        $tokensDAO = new TokensDAO();
        $refreshTokenExists = $tokensDAO->verifyRefreshToken($refreshToken);
        if (!$refreshTokenExists) return $response->withStatus(401);

        $tokensDAO->disableToken($refreshToken);

        $usersDAO = new UsersDAO();
        $user = $usersDAO->getUserByEmail($refreshTokenDecoded->email);
        if (is_null($user)) return $response->withStatus(401);

        $tokenPayload = [
            'sub' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'expired_at' => $expire_date,
            'active' => $is_active
        ];
        $token = JWT::encode($tokenPayload, getenv('JWT_SECRET_KEY'));

        $refreshTokenPayload = [
            'email' => $user->getEmail(),
            'random' => uniqid()
        ];
        $refreshToken = JWT::encode($refreshTokenPayload, getenv('JWT_SECRET_KEY'));

        $tokenModel = new TokenModel();
        $tokenModel->setUserId($user->getId())
            ->setToken($token)
            ->setRefreshToken($refreshToken)
            ->setExpiredAt($expire_date)
            ->setActive($is_active);

        $tokensDAO = new TokensDAO();
        $tokensDAO->createToken($tokenModel);

        $response = $response->withJson([
            "token" => $token,
            "refresh_token" => $refreshToken
        ]);
        return $response;
    }
}
