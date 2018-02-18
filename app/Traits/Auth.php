<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 15.02.18
 * Time: 12:27
 */

namespace App\Traits;

use App\Contracts\AbstractAuthorization;
use App\Entities\Users;
use App\Factories\AuthorizationFactory;
use App\Services\Authorization;

trait Auth
{

    /**
     * Authorization service instance
     * @var Authorization
     */
    public $authorization;

    /**
     * Auth constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->authorization = AuthorizationFactory::create();

        if (!$this->authorization instanceof AbstractAuthorization) {
            throw new \Exception('$this->authorization Must be instance of AbstractAuthorization');
        }
    }

    /**
     * @param string $username
     * @param string $password
     * @return bool
     * @throws \App\Exceptions\UserException
     */
    public function authAuthorize(string $username, string $password): bool
    {
        return $this->authorization->authorize($username, $password);
    }

    /**
     * @return bool
     */
    public function authAuthorized(): bool
    {
        return $this->authorization->authorized();
    }

    /**
     * @return \App\Entities\Users|bool
     */
    public function authGetUser(): Users
    {
        return $this->authorization->getUser();
    }

    public function authLogout(): void
    {
        $this->authorization->logout();
    }
}