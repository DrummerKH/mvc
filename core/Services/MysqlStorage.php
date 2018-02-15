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
    protected function connect(): \PDO
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
     * @return \PDOStatement
     */
    public function query(string $query, array $parameters): \PDOStatement
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($this->prepareParameters($parameters));
        return $this->statement;
    }

    /**
     * @return array
     */
    public function fetch(): array
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
    public function beginTransaction(): void
    {
        $this->connection->beginTransaction();
    }

    /**
     * Commit transaction
     * @return void
     */
    public function commit(): void
    {
        $this->connection->commit();
    }

    /**
     * Rollback transaction
     */
    public function rollback(): void
    {
        $this->connection->rollBack();
    }
}
