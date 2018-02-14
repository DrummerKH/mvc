<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 17:06
 */

namespace Core\Contracts;


abstract class AbstractStorageManager
{
    protected $config_file = 'db.php';
    protected $config = [];
    protected $statement;

    protected $connection;

    public function __construct()
    {
        $this->config = include_once config_path() . "/$this->config_file";
        $this->connection = $this->connect();
    }

    abstract protected function connect();

    abstract public function query(string $query, array $parameters);

    abstract public function beginTransaction();

    abstract public function commit();

    abstract public function transaction(callable $callback);

    abstract public function fetch();
}