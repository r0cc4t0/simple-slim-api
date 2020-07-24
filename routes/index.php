<?php

use function src\{slimConfiguration, basicAuth};

use app\Controllers\{StoreController, ProductController};

$app = new \Slim\App(slimConfiguration());

$app->group('', function () use ($app) {
    $app->get('/store', StoreController::class . ':getStores');
    $app->post('/store', StoreController::class . ':insertStore');
    $app->put('/store', StoreController::class . ':updateStore');
    $app->delete('/store', StoreController::class . ':deleteStore');

    $app->get('/product', ProductController::class . ':getProducts');
    $app->post('/product', ProductController::class . ':insertProduct');
    $app->put('/product', ProductController::class . ':updateProduct');
    $app->delete('/product', ProductController::class . ':deleteProduct');
})->add(basicAuth());

$app->run();
