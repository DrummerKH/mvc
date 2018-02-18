<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 17:56
 */

namespace App\Entities;


class Users
{
    /**
     * Table name
     * @var string
     */
    public static $table_name = 'users';
    /**
     * @var integer
     */
    public $id;
    /**
     * @var string
     */
    public $name;
    /**
     * @var float
     */
    public $balance;
    /**
     * @var string
     */
    public $password;

    public function __construct(string $name, float $balance = 0, int $id = null, string $password = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->balance = $balance;
        $this->password = $password;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @param float $balance
     */
    public function setBalance(float $balance): void
    {
        $this->balance = $balance;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}