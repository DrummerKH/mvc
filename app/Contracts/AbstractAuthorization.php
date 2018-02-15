<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 15.02.18
 * Time: 13:49
 */

namespace App\Contracts;

use App\Entities\Users;
use Core\Contracts\AbstractStorageManager;

abstract class AbstractAuthorization
{
    /**
     * Storage instance
     * @var AbstractStorageManager
     */
    protected $storage;

    /**
     * Authorisation constructor.
     * @param AbstractStorageManager $storage
     */
    public function __construct(AbstractStorageManager $storage)
    {
        $this->storage = $storage;
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
     * Check password
     * @param string $string
     * @param string $hash
     * @return mixed
     */
    abstract protected function verifyPassword(string $string, string $hash): bool;

    /**
     * Logout user
     * @return mixed
     */
    abstract function logout(): bool;

    /**
     * Close session
     * @return void
     */
    abstract function closeSession(): void;
}