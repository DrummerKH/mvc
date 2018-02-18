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
use Core\Contracts\AbstractSession;
use Core\Factories\ControllerFactory;

class Core
{
    protected $routing;
    protected $request;
    protected $response;

    public function __construct(
        AbstractRouting $routing,
        AbstractRequest $request,
        AbstractResponse $response,
        AbstractSession $session
    ) {
        $this->routing = $routing;
        $this->request = $request;
        $this->response = $response;

        ini_set('display_errors', false);
    }

    /**
     * Initial core method
     * @throws Exceptions\SessionException
     * @throws \Exception
     */
    public function init(): Core
    {
        Session::getInstance()->check();

        $controller = $this->routing->getControllerByUri($this->request->getController());

        $method = $this->request->getMethod() ?: 'index'; # Get method, instead of get default

        ControllerFactory::createController($controller, $this->request, $this->response)->{$method}();

        return $this;
    }
}