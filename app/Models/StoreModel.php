<?php

namespace app\Models;

final class StoreModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $phone_number;

    /**
     * @var string
     */
    private $address;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return StoreModel
     */
    public function setId(int $id): StoreModel
    {
        $this->id = $id;
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
     * @return StoreModel
     */
    public function setName(string $name): StoreModel
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    /**
     * @param string $phone_number
     * @return StoreModel
     */
    public function setPhoneNumber(string $phone_number): StoreModel
    {
        $this->phone_number = $phone_number;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return StoreModel
     */
    public function setAddress(string $address): StoreModel
    {
        $this->address = $address;
        return $this;
    }
}
