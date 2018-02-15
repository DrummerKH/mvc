<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 12:18
 */

namespace Core;

use Core\Contracts\AbstractRouting;

class Routing extends AbstractRouting
{
    /**
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * @param string $uri
     * @return string
     */
    public function getControllerByUri(string $uri): string
    {
        return $this->routes[$uri];
    }
}