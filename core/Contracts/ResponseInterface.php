<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 15:20
 */

namespace Core\Contracts;


interface ResponseInterface
{
    public static function getInstance();
    public function render(string $view, array $parameters = []);
    public function setResponseCode(int $response_code);
    public function setHeader(string $name, string $value);
}