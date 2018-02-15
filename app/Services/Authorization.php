<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 15.02.18
 * Time: 11:30
 */

namespace App\Services;


use App\Contracts\AbstractAuthorization;
use App\Entities\Users;
use App\Exceptions\UserException;
use App\Repositories\UsersRepository;

class Authorization extends AbstractAuthorization
{
    /**
     * @param string $username
     * @param string $password
     * @return bool
     * @throws UserException
     */
    public function authorize(string $username, string $password): bool
    {
        $userRepository = new UsersRepository($this->storage);

        $user = $userRepository->findByName($username);

        if (!$user)
            throw new UserException('User not found');

        if($this->verifyPassword($password, $user->getPassword())) {
            $_SESSION['user_id'] = $user->getId();
            return true;
        }

        return false;
    }

    /**
     * Does user authorised
     * @return bool
     */
    public function authorized(): bool
    {
        return isset($_SESSION['user_id']);
    }

    /**
     * @return \App\Entities\Users|bool
     */
    public function getUser(): Users
    {
        $userRepository = new UsersRepository($this->storage);
        return $userRepository->findById($_SESSION['user_id']);
    }

    /**
     * @param string $string
     * @param string $hash
     * @return bool|string
     */
    protected function verifyPassword(string $string, string $hash): bool
    {
        return password_verify($string, $hash);
    }

    /**
     * @return bool
     */
    public function logout(): bool
    {
        return session_destroy();
    }

    /**
     * Close session
     */
    public function closeSession(): void
    {
        session_write_close();
    }

    /**
     * Destruct and close session
     */
    public function __destruct()
    {
        $this->closeSession();
    }

}