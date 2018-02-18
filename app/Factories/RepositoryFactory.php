<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 18.02.18
 * Time: 21:12
 */

namespace App\Factories;


use Core\Contracts\AbstractRepository;
use Core\MysqlStorage;

class RepositoryFactory
{
    /**
     * @param string $repository
     * @return AbstractRepository
     * @throws \Exception
     */
    public static function create(string $repository): AbstractRepository
    {
        if (!class_exists($repository)) {
            throw new \Exception('Repository does not exists');
        }
        return new $repository(new MysqlStorage);
    }
}