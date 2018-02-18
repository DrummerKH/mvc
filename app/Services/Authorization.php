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
use Core\Session;

class Authorization extends AbstractAuthorization
{
    /**
     * @var UsersRepository
     */
    protected $userRepository;

    /**
     * @param string $username
     * @param string $password
     * @return bool
     * @throws UserException
     */
    public function authorize(string $username, string $password): bool
    {
        /**
         * @var Users $user
         */
        $user = $this->userRepository->findByName($username);

        if (!$user) {
            throw new UserException('User not found');
        }

        if ($this->verifyPassword($password, $user->getPassword())) {

            Session::getInstance()
                ->regenerate()
                ->set('user_id', $user->getId());

            return true;
        }

        return false;
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
     * Does user authorised
     * @return bool
     */
    public function authorized(): bool
    {
        return (bool)Session::getInstance()->get('user_id');
    }

    /**
     * @return \App\Entities\Users|bool
     */
    public function getUser(): Users
    {
        return $this->userRepository->findById(Session::getInstance()->get('user_id'));
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        Session::getInstance()
            ->set('destroyed_time', time())
            ->remove('user_id');
    }
}