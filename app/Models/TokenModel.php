<?php

namespace app\Models;

final class TokenModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $user_id;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $refresh_token;

    /**
     * @var string
     */
    private $expired_at;

    /**
     * @var int
     */
    private $active;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return TokenModel
     */
    public function setId(int $id): TokenModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     * @return TokenModel
     */
    public function setUserId(int $user_id): TokenModel
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return TokenModel
     */
    public function setToken(string $token): TokenModel
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getRefreshToken(): string
    {
        return $this->refresh_token;
    }

    /**
     * @param string $refresh_token
     * @return TokenModel
     */
    public function setRefreshToken(string $refresh_token): TokenModel
    {
        $this->refresh_token = $refresh_token;
        return $this;
    }

    /**
     * @return string
     */
    public function getExpiredAt(): string
    {
        return $this->expired_at;
    }

    /**
     * @param string $expired_at
     * @return TokenModel
     */
    public function setExpiredAt(string $expired_at): TokenModel
    {
        $this->expired_at = $expired_at;
        return $this;
    }

    /**
     * @return int
     */
    public function getActive(): int
    {
        return $this->active;
    }

    /**
     * @param int $active
     * @return TokenModel
     */
    public function setActive(int $active): TokenModel
    {
        $this->active = $active;
        return $this;
    }
}
