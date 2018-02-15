<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 15.02.18
 * Time: 10:33
 */

namespace App\Services;

use App\Contracts\AbstractPayments;
use App\Entities\Transactions;
use App\Repositories\TransactionsRepository;
use App\Repositories\UsersRepository;
use App\Exceptions\UserException;

class Payments extends AbstractPayments
{
    /**
     * Withdraw user money
     * @param int $user_id
     * @param float $amount
     * @throws UserException
     */
    public function transaction(int $user_id, float $amount): void
    {
        $this->storage->withShareLock();

        $usersRepository = new UsersRepository($this->storage);
        $user = $usersRepository->findById($user_id);

        if(!$user)
            throw new UserException('User not found');

        $transaction = new Transactions($user_id, $amount);
        $transactionsRepository = new TransactionsRepository($this->storage);

        $this->storage->beginTransaction();

        $transactionsRepository->save($transaction);

        if ($user->getBalance() + $amount >= 0)
            $usersRepository->updateBalance($user, $amount);
        else
            throw new UserException('Not enough funds');

        $this->storage->commit();
    }
}