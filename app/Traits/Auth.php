<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 15.02.18
 * Time: 12:27
 */

namespace App\Traits;

use App\Contracts\AbstractAuthorization;
use App\Services\Authorization;
use Core\MysqlStorage;

trait Auth {

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
        session_start();

        $this->authorization = new Authorization(new MysqlStorage);

        if(! $this->authorization instanceof AbstractAuthorization)
            throw new \Exception('$this->authorization Must be instance of AbstractAuthorization');
    }

    /**
     * @param string $username
     * @param string $password
     * @return bool
     * @throws \App\Exceptions\UserException
     */
    public function authAuthorize(string $username, string $password)
    {
        return $this->authorization->authorize($username, $password);
    }

    /**
     * @return bool
     */
    public function authAuthorized()
    {
        return $this->authorization->authorized();
    }

    /**
     * @return \App\Entities\Users|bool
     */
    public function authGetUser()
    {
        return $this->authorization->getUser();
    }

    public function authLogout()
    {
        return $this->authorization->logout();
    }

    public function authCloseSession()
    {
        unset($this->authorization);
    }
}