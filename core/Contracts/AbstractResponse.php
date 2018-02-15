<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 15:20
 */

namespace Core\Contracts;


abstract class AbstractResponse
{
    abstract public function render(string $view, array $parameters = []);
    abstract public function setResponseCode(int $response_code);
    abstract public function setHeader(string $name, string $value);
}