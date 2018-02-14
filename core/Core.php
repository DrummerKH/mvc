<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 12:00
 */

namespace Core;

use Core\Contracts\RequestInterface;
use Core\Contracts\ResponseInterface;
use Core\Contracts\RoutingInterface;
use Core\Fabrics\ControllerFabric;

class Core
{
    public function init(RoutingInterface $routing, RequestInterface $request, ResponseInterface $response)
    {
        $controller = $routing->getControllerByUri($request->getController());

        $method = $request->getMethod() ?: 'index';

        ControllerFabric::createController($controller)->{$method}($request, $response);
    }
}