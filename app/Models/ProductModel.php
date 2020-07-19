<?php

namespace app\Models;

final class ProductModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $store_id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $price;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ProductModel
     */
    public function setId(int $id): ProductModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getStoreId(): int
    {
        return $this->store_id;
    }

    /**
     * @param int $store_id
     * @return ProductModel
     */
    public function setStoreId(int $store_id): ProductModel
    {
        $this->store_id = $store_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ProductModel
     */
    public function setName(string $name): ProductModel
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return ProductModel
     */
    public function setPrice(float $price): ProductModel
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return ProductModel
     */
    public function setQuantity(int $quantity): ProductModel
    {
        $this->quantity = $quantity;
        return $this;
    }
}
