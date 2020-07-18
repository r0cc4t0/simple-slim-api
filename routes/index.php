<?php

use function src\slimConfiguration;

use app\Controllers\ProductController;
use app\Controllers\StoreController;

$app = new \Slim\App(slimConfiguration());

$app->get('/products', ProductController::class . ':getProducts');
$app->get('/stores', StoreController::class . ':getStores');

$app->run();
