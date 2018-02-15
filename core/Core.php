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
    public function init(AbstractRouting $routing, AbstractRequest $request, AbstractResponse $response)
    {
        $controller = $routing->getControllerByUri($request->getController());

        $method = $request->getMethod() ?: 'index';

        ControllerFactory::createController($controller, $request, $response)->{$method}();
    }
}