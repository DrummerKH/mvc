<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 12:26
 */

namespace Core;

use Core\Contracts\RoutesInterface;

class Routes implements RoutesInterface
{
    public $routes = [];

    public function __construct(array $attributes)
    {
        $this->routes[$attributes[0]] = $attributes[1];
    }

    public function getControllerByUri(string $uri)
    {
        return $this->routes[$uri];
    }
}