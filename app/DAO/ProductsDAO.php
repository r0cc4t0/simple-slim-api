<?php

namespace app\DAO;

class ProductsDAO extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllProducts()
    {
        $products = $this->pdo
            ->query('SELECT * FROM products;')
            ->fetchAll(\PDO::FETCH_ASSOC);
        echo "<pre>";
        foreach ($products as $product) {
            var_dump($product);
        }
        die;
    }
}
