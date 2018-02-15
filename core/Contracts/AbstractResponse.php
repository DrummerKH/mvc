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
    /**
     * Render view
     * @param string $view
     * @param array $parameters
     */
    abstract public function render(string $view, array $parameters = []);

    /**
     * Set response http code of
     * @param int $response_code
     * @return mixed
     */
    abstract public function setResponseCode(int $response_code);

    /**
     * Set HTTP Headers to response
     * @param string $name
     * @param string $value
     * @return mixed
     */
    abstract public function setHeader(string $name, string $value);

    /**
     * Load view from file
     * @param string $view_file
     * @param array $parameters
     * @return string
     */
    abstract protected function loadView(string $view_file, array $parameters = []): string;

    /**
     * Redirect to another address
     * @param string $uri
     * @param int $code
     */
    abstract public function redirect(string $uri, int $code = 301): void;
}