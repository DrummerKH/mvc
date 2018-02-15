<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 15.02.18
 * Time: 13:58
 */

namespace App\Contracts;


use Core\Contracts\AbstractStorageManager;

abstract class AbstractPayments
{
    /**
     * Storage instance
     * @var AbstractStorageManager
     */
    protected $storage;

    public function __construct(AbstractStorageManager $storage)
    {
        $this->storage = $storage;
    }

    /**
     * Withdraw user money
     * @param int $user_id
     * @param float $amount
     * @return mixed
     */
    abstract function transaction(int $user_id, float $amount): void;
}