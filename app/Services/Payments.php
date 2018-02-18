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
use App\Entities\Users;
use App\Exceptions\UserException;
use App\Factories\RepositoryFactory;
use App\Repositories\TransactionsRepository;
use App\Repositories\UsersRepository;

class Payments extends AbstractPayments
{
    /**
     * Withdraw user money
     * @param Users $user
     * @param float $amount
     * @throws UserException
     * @throws \Exception
     */
    public function withdraw(Users $user, float $amount): void
    {
        if ($amount <= 0) {
            throw new UserException('Amount must be greater than 0');
        }

        /** @var UsersRepository $usersRepository */
        $usersRepository = RepositoryFactory::create(UsersRepository::class);

        /** @var TransactionsRepository $transactionsRepository */
        $transactionsRepository = RepositoryFactory::create(TransactionsRepository::class);

        # Execute transaction
        $this->storage->beginTransaction();

        # Lock user row for update
        if (!$lockedUser = $usersRepository->forUpdate()->findById($user->getId())) {
            throw new UserException('User node found');
        }

        if ($lockedUser->getBalance() - $amount < 0) {
            throw new UserException('Not enough funds');
        }

        $transaction = new Transactions($lockedUser->getId(), -$amount);

        # Update user balance
        $usersRepository->updateBalance($lockedUser, -$amount);

        # Add transaction row
        $transactionsRepository->save($transaction);

        $this->storage->commit();
    }
}