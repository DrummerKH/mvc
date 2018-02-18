<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 18.02.18
 * Time: 18:06
 */

namespace Core;


use Core\Contracts\AbstractSession;
use Core\Exceptions\SessionException;

final class Session extends AbstractSession
{
        /**
     * @var Session singleton instance
     */
    private static $instance; #sec
protected $session_lifetime = 180;

    /**
     * Session constructor
     */
    private function __construct()
    {
        ini_set('session.use_strict_mode', true);
        ini_set('session.use_only_cookies ', true);

        $this->start()
            ->commit();
    }

    /**
     * Gets the instance via lazy initialization (created on first usage)
     * @return Session
     */
    public static function getInstance(): Session
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Check session properties
     * @throws SessionException
     * @throws \Exception
     * @return Session
     */
    public function check(): AbstractSession
    {
        # Check if new session was generated but Cookies was missed
        if ($this->get('destroyed_time')) {

            if ($this->get('destroyed_time') && time() - $this->get('destroyed_time') > 60) {

                # Access to old destroyed session
                # Logout user and throw exception, potential hack
                $this->set('destroyed_time', time())
                    ->remove('user_id');
                throw new SessionException('Access to old destroyed session');

            } elseif ($this->get('new_session_id')) {

                # Recreate session with created id
                $this->create($this->get('new_session_id'));
            }
        }

        # Check session lifetime, if over - regenerate
        if ($this->get('created_time') && time() - $this->get('created_time') > $this->session_lifetime) {
            $this->regenerate();
        }

        return $this;
    }

    /**
     * Start session with given ID
     * @param string $session_id
     * @return Session
     */
    protected function create(string $session_id): AbstractSession
    {
        session_id($session_id);

        return $this->set('created_time', time())
            ->start()
            ->remove('destroyed_time')
            ->remove('new_session_id');
    }

    /**
     * Generate session with new ID
     * @return Session
     */
    public function regenerate(): AbstractSession
    {
        $new_session_id = session_create_id();

        return $this->set('destroyed_time', time())
            ->set('new_session_id', $new_session_id)
            ->create($new_session_id);
    }

    private function __clone()
    {
    }
}