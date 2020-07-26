<?php

namespace app\DAO;

use app\Models\UserModel;

class UsersDAO extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUserByEmail(string $email): ?UserModel
    {
        $statement = $this->pdo
            ->prepare('SELECT * FROM users WHERE email = :email');
        $statement->bindParam('email', $email);
        $statement->execute();
        $users = $statement->fetchAll(\PDO::FETCH_ASSOC);

        if (count($users) === 0) return null;
        $user = new UserModel();
        $user->setId($users[0]['id'])
            ->setName($users[0]['name'])
            ->setEmail($users[0]['email'])
            ->setPassword($users[0]['password']);
        return $user;
    }
}
