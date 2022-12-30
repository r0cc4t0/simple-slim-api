<?php

namespace app\DAO;

use app\Models\ProductModel;

class ProductsDAO extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllProducts(): array
    {
        $products = $this->pdo
            ->query('SELECT * FROM products;')
            ->fetchAll(\PDO::FETCH_ASSOC);

        return $products;
    }

    public function getProductById(int $id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM products WHERE id = :id');
        $statement->bindParam('id', $id);
        $statement->execute();
        
        $product = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $product;
    }

    public function insertProduct(ProductModel $product): void
    {
        $statement = $this->pdo
            ->prepare('INSERT INTO products 
                VALUES (null, :store_id, :name, :price, :quantity);');

        $statement->execute([
            'store_id' => $product->getStoreId(),
            'name' => $product->getName(),
            'price' => $product->getPrice(),
            'quantity' => $product->getQuantity()
        ]);
    }

    public function updateProduct(ProductModel $product): void
    {
        $statement = $this->pdo
            ->prepare('UPDATE products SET 
                store_id = :store_id,
                name = :name,
                price = :price,
                quantity = :quantity
                WHERE id = :id;');

        $statement->execute([
            'store_id' => $product->getStoreId(),
            'name' => $product->getName(),
            'price' => $product->getPrice(),
            'quantity' => $product->getQuantity(),
            'id' => $product->getId()
        ]);
    }

    public function deleteProduct(int $id): void
    {
        $statement = $this->pdo
            ->prepare('DELETE FROM products WHERE id = :id;');

        $statement->execute([
            'id' => $id
        ]);
    }
}
