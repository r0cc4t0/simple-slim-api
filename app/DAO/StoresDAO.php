<?php

namespace app\DAO;

class StoresDAO extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllStores()
    {
        $stores = $this->pdo
            ->query('SELECT * FROM stores;')
            ->fetchAll(\PDO::FETCH_ASSOC);
        echo "<pre>";
        foreach ($stores as $store) {
            var_dump($store);
        }
        die;
    }
}
