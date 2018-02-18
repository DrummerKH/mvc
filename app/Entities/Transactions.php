<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 17:58
 */

namespace App\Entities;


class Transactions
{
    /**
     * @var string
     */
    public static $table_name = 'transactions';
    /**
     * @var integer
     */
    public $id;
    /**
     * @var integer
     */
    public $user_id;
    /**
     * @var float
     */
    public $amount;
    /**
     * @var string
     */
    public $created_at;

    public function __construct(int $user_id, float $amount)
    {
        $this->user_id = $user_id;
        $this->amount = $amount;
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
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}