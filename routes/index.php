<?php

use function src\{slimConfiguration, basicAuth, jwtAuth};
use app\Controllers\{StoreController, ProductController, AuthController, UserController};
use app\Middlewares\JwtDateTimeMiddleware;

$app = new \Slim\App(slimConfiguration());

$app->post('/login', AuthController::class . ':login');
$app->post('/refresh_token', AuthController::class . ':refreshToken');

$app->group('', function () use ($app) {
    $app->get('/store', StoreController::class . ':getStores');
    $app->post('/store', StoreController::class . ':insertStore');
    $app->put('/store', StoreController::class . ':updateStore');
    $app->delete('/store', StoreController::class . ':deleteStore');

    $app->get('/product', ProductController::class . ':getProducts');
    $app->post('/product', ProductController::class . ':insertProduct');
    $app->put('/product', ProductController::class . ':updateProduct');
    $app->delete('/product', ProductController::class . ':deleteProduct');

    $app->get('/user', UserController::class . ':getUsers');
    $app->post('/user', UserController::class . ':insertUser');
    $app->put('/user', UserController::class . ':updateUser');
    $app->delete('/user', UserController::class . ':deleteUser');
})
    //->add(basicAuth());
    ->add(new JwtDateTimeMiddleware())
    ->add(jwtAuth());

$app->run();
