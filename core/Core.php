<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 12:00
 */

namespace Core;

use Core\Contracts\AbstractRequest;
use Core\Contracts\AbstractResponse;
use Core\Contracts\AbstractRouting;
use Core\Factories\ControllerFactory;

class Core
{
    /**
     * Initial core method
     * @param AbstractRouting $routing
     * @param AbstractRequest $request
     * @param AbstractResponse $response
     */
    public function init(AbstractRouting $routing, AbstractRequest $request, AbstractResponse $response): void
    {
        $controller = $routing->getControllerByUri($request->getController());

        $method = $request->getMethod() ?: 'index'; # Get method, instead of get default

        ControllerFactory::createController($controller, $request, $response)->{$method}();
    }
}