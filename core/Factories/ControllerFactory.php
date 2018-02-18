<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 12:55
 */

namespace Core\Factories;

use Core\Contracts\AbstractController;
use Core\Contracts\AbstractRequest;
use Core\Contracts\AbstractResponse;

class ControllerFactory
{
    /**
     * @param string $controller
     * @param AbstractRequest $request
     * @param AbstractResponse $response
     * @return AbstractController
     */
    public static function createController(
        string $controller,
        AbstractRequest $request,
        AbstractResponse $response
    ): AbstractController {
        $object = new $controller();
        $object->request = $request;
        $object->response = $response;
        return $object;
    }
}