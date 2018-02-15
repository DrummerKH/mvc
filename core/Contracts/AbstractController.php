<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 23:13
 */

namespace Core\Contracts;


abstract class AbstractController
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