<?php

namespace app\DAO;

abstract class Connection
{
    /**
     * @var \PDO
     */
    protected $pdo;

    public function __construct()
    {
        $db_host = getenv('DB_HOST');
        $db_port = getenv('DB_PORT');
        $db_name = getenv('DB_NAME');
        $db_user = getenv('DB_USER');
        $db_pass = getenv('DB_PASS');

        $dsn = "mysql:host={$db_host};dbname={$db_name};port={$db_port}";

        $this->pdo = new \PDO($dsn, $db_user, $db_pass);
        $this->pdo->setAttribute(
            \PDO::ATTR_ERRMODE,
            \PDO::ERRMODE_EXCEPTION
        );
    }
}
