<?php

namespace app\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use app\Exceptions\TestException;

final class ExceptionController
{
    public function test(Request $request, Response $response, array $args): Response
    {
        try {
            throw new TestException('Testing...');
            return $response->withJson(['message' => 'OK']);
        } catch(TestException $ex) {
            return $response->withJson([
                'error' => TestException::class,
                'status' => 400,
                'code' => '003',
                'userMessage' => 'Just testing...',
                'developerMessage' => $ex->getMessage()
            ], 400);
        } catch(\InvalidArgumentException $ex) {
            return $response->withJson([
                'error' => \InvalidArgumentException::class,
                'status' => 400,
                'code' => '002',
                'userMessage' => 'It is necessary to send all data for login.',
                'developerMessage' => $ex->getMessage()
            ], 400);
        } catch(\Exception | \Throwable $ex) {
            return $response->withJson([
                'error' => \Exception::class,
                'status' => 500,
                'code' => '001',
                'userMessage' => 'Application error! Contact your system administrator.',
                'developerMessage' => $ex->getMessage()
            ], 500);
        }
    }
}
