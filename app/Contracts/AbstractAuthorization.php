<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 15.02.18
 * Time: 13:49
 */

namespace App\Contracts;

use App\Entities\Users;
use Core\Contracts\AbstractRepository;

abstract class AbstractAuthorization
{
    /**
     * @var AbstractRepository
     */
    protected $userRepository;

    /**
     * Authorisation constructor.
     * @param AbstractRepository $usersRepository
     */
    public function __construct(AbstractRepository $usersRepository)
    {
        $this->userRepository = $usersRepository;
    }

    /**
     * Authorize user
     * @param string $username
     * @param string $password
     * @return mixed
     */
    abstract function authorize(string $username, string $password): bool;

    /**
     * Does user authorised
     * @return mixed
     */
    abstract function authorized(): bool;

    /**
     * Get authorised user
     * @return mixed
     */
    abstract function getUser(): Users;

    /**
     * Logout user
     * @return mixed
     */
    abstract function logout(): void;

    /**
     * Check password
     * @param string $string
     * @param string $hash
     * @return mixed
     */
    abstract protected function verifyPassword(string $string, string $hash): bool;
}