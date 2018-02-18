<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 12:49
 */

namespace Core\Contracts;


abstract class AbstractRouting
{
    /**
     * Routes config fle
     * @var string
     */
    protected $config_file = 'routes.php';

    /**
     * Array of uri and controllers
     * @var array
     */
    protected $routes = [];

    public function __construct()
    {
        $this->routes = require_once config_path() . "/$this->config_file";
    }

    /**
     * Get routes array
     * @return array
     */
    abstract public function getRoutes(): array;

    /**
     * Get controller by URI
     * @param string $uri
     * @return string
     */
    abstract public function getControllerByUri(string $uri): string;
}