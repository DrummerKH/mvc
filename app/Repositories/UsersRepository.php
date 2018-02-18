<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 18:00
 */

namespace App\Repositories;

use App\Entities\Users;
use Core\Contracts\AbstractRepository;

class UsersRepository extends AbstractRepository
{
    /**
     * Find user by ID
     * @param int $id
     * @return Users|null
     */
    public function findById(int $id)
    {
        $result = $this->storage->query(
            "SELECT * FROM " . Users::$table_name . " WHERE `id` = :id" . (
            $this->storage->forUpdate ? ' FOR UPDATE' : ''
            ),
            [
                'id' => $id
            ]
        )->fetch();

        if (empty($result[0])) {
            return null;
        }

        return new Users($result[0]['name'], $result[0]['balance'], $result[0]['id'], $result[0]['password']);

    }

    /**
     * Find user by name
     * @param string $name
     * @return Users|null
     */
    public function findByName(string $name)
    {
        $result = $this->storage->query(
            "SELECT * FROM " . Users::$table_name . " WHERE `name` = :name" . (
            $this->storage->forUpdate ? ' FOR UPDATE' : ''
            ),
            [
                'name' => $name
            ]
        )->fetch();

        if (empty($result[0])) {
            return null;
        }

        return new Users($result[0]['name'], $result[0]['balance'], $result[0]['id'], $result[0]['password']);

    }

    /**
     * Update user balance
     * @param Users $user
     * @param float $amount
     */
    public function updateBalance(Users $user, float $amount): void
    {
        $this->storage->query(
            "UPDATE " . Users::$table_name . " SET balance = balance + :balance WHERE `id` = :id",
            [
                'balance' => $amount,
                'id' => $user->getId()
            ]
        );
    }
}