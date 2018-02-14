<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 12:18
 */

namespace Core;

use Core\Contracts\RoutingInterface;

class Routing implements RoutingInterface
{
    protected $config_file ='routes.php';

    protected $configs = [];

    protected $routes = [];

    public function __construct()
    {
        $this->routes = require_once config_path() . "/$this->config_file";
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function getControllerByUri(string $uri): string
    {
        return $this->routes[$uri];
    }
}