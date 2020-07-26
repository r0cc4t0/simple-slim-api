<?php

namespace app\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class JwtDateTimeMiddleware
{
    public function __invoke(Request $request, Response $response, callable $next): Response
    {
        $token = $request->getAttribute('jwt');
        $expired_at = new \DateTime($token['expired_at']);
        $now = new \DateTime();
        if ($expired_at < $now) return $response->withStatus(401);
        $response = $next($request, $response);
        return $response;
    }
}
