<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 15:38
 */
namespace Core;

use Core\Contracts\AbstractStorageManager;

class MysqlStorage extends AbstractStorageManager
{
    /**
     * @return \PDO
     */
    protected function connect()
    {
        return new \PDO(
            "mysql:host={$this->config['host']};dbname={$this->config['dbname']};port={$this->config['port']}",
            $this->config['username'],
            $this->config['password'],
            [
                \PDO::ATTR_PERSISTENT => true
            ]
        );
    }

    /**
     * @param string $query
     * @param array $parameters
     * @return MysqlStorage
     */
    public function query(string $query, array $parameters)
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($this->prepareParameters($parameters));
        return $this->statement;
    }

    /**
     * @return mixed
     */
    public function fetch()
    {
        return $this->statement->fetchAll();
    }

    /**
     * @param array $parameters
     * @return array
     */
    private function prepareParameters(array $parameters): array
    {
        $result_params = [];
        foreach ($parameters as $key => $value) {
            $result_params[":$key"] = $value;
        }
        return $result_params;
    }

    /**
     * Start transaction
     * @return void
     */
    public function beginTransaction()
    {
        $this->connection->beginTransaction();
    }

    /**
     * Commit transaction
     * @return void
     */
    public function commit()
    {
        $this->connection->commit();
    }

    public function rollback()
    {
        $this->connection->rollBack();
    }
}
