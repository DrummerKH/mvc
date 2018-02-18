<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 18.02.18
 * Time: 21:20
 */

namespace Core\Factories;


use Core\Core;
use Core\Request;
use Core\Response;
use Core\Routing;
use Core\Session;

class CoreFactory
{
    /**
     * Core class factory
     * @return Core
     */
    public static function create(): Core
    {
        return new Core(new Routing, new Request, new Response, Session::getInstance());
    }
}