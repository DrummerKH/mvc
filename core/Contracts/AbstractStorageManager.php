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
    /**
     * Need set share lock during select or not
     * @var bool
     */
    public $shareLock = false;

    /**
     * Database credentials config file
     * @var string
     */
    protected $config_file = 'db.php';

    /**
     * Config array
     * @var array
     */
    protected $config = [];

    /**
     * @var mixed
     */
    protected $statement;

    /**
     * @var mixed
     */
    protected $connection;

    public function __construct()
    {
        $this->config = include config_path() . "/$this->config_file";
        $this->connection = $this->connect();
    }

    public function withShareLock()
    {
        $this->shareLock = true;
    }

    /**
     * Connect to storage
     * @return mixed
     */
    abstract protected function connect();

    /***
     * Perform query
     * @param string $query
     * @param array $parameters
     * @return mixed
     */
    abstract public function query(string $query, array $parameters);

    /**
     * Start transaction
     * @return mixed
     */
    abstract public function beginTransaction();

    /**
     * Commit transaction
     * @return mixed
     */
    abstract public function commit();

    /**
     * Get data from query
     * @return mixed
     */
    abstract public function fetch();
}