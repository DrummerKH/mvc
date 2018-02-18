<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 18.02.18
 * Time: 21:05
 */

namespace App\Factories;


use App\Repositories\UsersRepository;
use App\Services\Authorization;
use Core\MysqlStorage;

class AuthorizationFactory
{
    /**
     * @return Authorization
     */
    public static function create(): Authorization
    {
        return new Authorization(new UsersRepository(new MysqlStorage));
    }
}