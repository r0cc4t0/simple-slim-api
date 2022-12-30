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

    public function getAllUsers(): array
    {
        $users = $this->pdo
            ->query('SELECT * FROM users;')
            ->fetchAll(\PDO::FETCH_ASSOC);

        return $users;
    }

    public function getUserById(int $id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE id = :id');
        $statement->bindParam('id', $id);
        $statement->execute();

        $user = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $user;
    }

    public function insertUser(UserModel $user): void
    {
        $statement = $this->pdo
            ->prepare('INSERT INTO users 
            VALUES (null, :name, :email, :password);');

        $statement->execute([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword()
        ]);
    }

    public function updateUser(UserModel $user): void
    {
        $statement = $this->pdo
            ->prepare('UPDATE users SET 
                name = :name,
                email = :email,
                password = :password
                WHERE id = :id;');

        $statement->execute([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'id' => $user->getId()
        ]);
    }

    public function deleteUser(int $id): void
    {
        $statement = $this->pdo
            ->prepare('DELETE FROM users WHERE id = :id;');

        $statement->execute([
            'id' => $id
        ]);
    }
}
