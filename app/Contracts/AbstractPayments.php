<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 15.02.18
 * Time: 13:58
 */

namespace App\Contracts;


use App\Entities\Users;
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
     * @param Users $user
     * @param float $amount
     * @return mixed
     */
    abstract function withdraw(Users $user, float $amount): void;
}