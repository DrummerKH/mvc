<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 18:14
 */

namespace App\Repositories;

use App\Entities\Transactions;
use Core\Contracts\AbstractRepository;

class TransactionsRepository extends AbstractRepository
{
    public function save(Transactions $transaction)
    {
        $this->storage->query(
            "INSERT INTO `" . Transactions::$table_name . "` (`user_id`, `amount`) VALUES (:user_id, :amount)",
            [
                'user_id' => $transaction->getUserId(),
                'amount' => $transaction->getAmount()
            ]
        );
    }
}