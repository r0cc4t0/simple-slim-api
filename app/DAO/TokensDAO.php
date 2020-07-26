<?php

namespace app\DAO;

use app\Models\TokenModel;

class TokensDAO extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createToken(TokenModel $token): void
    {
        $statement = $this->pdo
            ->prepare('INSERT INTO tokens VALUES 
                (null, :user_id, :token, :refresh_token, :expired_at, :active);');
        $statement->execute([
            'user_id' => $token->getUserId(),
            'token' => $token->getToken(),
            'refresh_token' => $token->getRefreshToken(),
            'expired_at' => $token->getExpiredAt(),
            'active' => $token->getActive()
        ]);
    }

    public function verifyRefreshToken(string $refreshToken): bool
    {
        $statement = $this->pdo
            ->prepare('SELECT id FROM tokens WHERE refresh_token = :refresh_token;');
        $statement->bindParam('refresh_token', $refreshToken);
        $statement->execute();
        $tokens = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return count($tokens) === 0 ? false : true;
    }
}
