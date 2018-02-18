<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 18.02.18
 * Time: 18:12
 */

namespace Core\Contracts;


abstract class AbstractSession
{
    abstract public function check(): AbstractSession;

    /**
     * @param string $key
     * @param string $value
     * @return AbstractSession
     */
    public function set(string $key, string $value)
    {
        $this->start();
        $_SESSION[$key] = $value;
        $this->commit();
        return $this;
    }

    /**
     * @param array $options
     * @return AbstractSession
     */
    protected function start($options = []): AbstractSession
    {
        if (!$this->isActive()) {
            session_start($options);
        }

        return $this;
    }

    /**
     * @return bool
     */
    protected function isActive(): bool
    {
        return session_status() == PHP_SESSION_ACTIVE;
    }

    /**
     * @return bool
     */
    protected function commit(): bool
    {
        return session_commit();
    }

    /**
     * @param string $key
     * @return string
     */
    public function get(string $key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    /**
     * @param $key
     * @return AbstractSession
     */
    public function remove($key): AbstractSession
    {
        $this->start();
        unset($_SESSION[$key]);
        $this->commit();
        return $this;
    }

    abstract protected function regenerate(): AbstractSession;

    abstract protected function create(string $session_id): AbstractSession;
}