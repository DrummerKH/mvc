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
    /**
     * Save transaction
     * @param Transactions $transaction
     */
    public function save(Transactions $transaction): void
    {
        $this->storage->query(
            "INSERT INTO `" . Transactions::$table_name . "` (`user_id`, `amount`) VALUES (:user_id, :amount)",
            [
                'user_id' => $transaction->getUserId(),
                'amount' => $transaction->getAmount()
            ]
        );
    }

    /**
     * Find user by ID
     * @param int $id
     * @return Transactions|null
     */
    public function findById(int $id)
    {
        $result = $this->storage->query(
            "SELECT * FROM " . Transactions::$table_name . " WHERE `id` = :id" . (
                $this->storage->forUpdate ? ' FOR UPDATE' : ''
            ),
            [
                'id' => $id
            ]
        )->fetchAll();

        if (empty($result[0])) {
            return null;
        }

        return new Transactions($result[0]['user_id'], $result[0]['amount']);

    }
}