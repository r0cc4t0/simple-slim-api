<?php

namespace app\DAO;

use app\Models\StoreModel;

class StoresDAO extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllStores(): array
    {
        $stores = $this->pdo
            ->query('SELECT * FROM stores;')
            ->fetchAll(\PDO::FETCH_ASSOC);

        return $stores;
    }

    public function getStoreById(int $id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM stores WHERE id = :id');
        $statement->bindParam('id', $id);
        $statement->execute();
        
        $store = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $store;
    }

    public function insertStore(StoreModel $store): void
    {
        $statement = $this->pdo
            ->prepare('INSERT INTO stores 
            VALUES (null, :name, :phone_number, :address);');

        $statement->execute([
            'name' => $store->getName(),
            'phone_number' => $store->getPhoneNumber(),
            'address' => $store->getAddress()
        ]);
    }

    public function updateStore(StoreModel $store): void
    {
        $statement = $this->pdo
            ->prepare('UPDATE stores SET 
                name = :name,
                phone_number = :phone_number,
                address = :address
                WHERE id = :id;');

        $statement->execute([
            'name' => $store->getName(),
            'phone_number' => $store->getPhoneNumber(),
            'address' => $store->getAddress(),
            'id' => $store->getId()
        ]);
    }

    public function deleteStore(int $id): void
    {
        $statement = $this->pdo
            ->prepare('DELETE FROM products WHERE store_id = :id;
                DELETE FROM stores WHERE id = :id;');

        $statement->execute([
            'id' => $id
        ]);
    }
}
