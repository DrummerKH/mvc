<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 12:55
 */

namespace Core\Fabrics;

class ControllerFabric
{
    public static function createController($controller)
    {
        return new $controller();
    }
}