<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 23:13
 */

namespace Core;


use Core\Contracts\AbstractRequest;
use Core\Contracts\AbstractResponse;

class Controller
{
    /**
     * @var AbstractRequest
     */
    public $request;

    /**
     * @var AbstractResponse
     */
    public $response;
}