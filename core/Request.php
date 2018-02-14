<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 12:18
 */

namespace Core;

use Core\Contracts\RequestInterface;

class Request implements RequestInterface {

    private static $instance;

    protected $uri;

    protected $query_params = [];

    protected $path;

    protected $controller;

    protected $method;

    private function __construct()
    {
        $this->path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);;
        parse_str($query, $this->query_params);

        $path = explode('/', $this->path);

        $this->controller = $path[0] ?: '/';
        $this->method = isset($path[1]) ? $path[1] : '';
    }

    private function __clone(){}

    /**
     * @return Request
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @return array
     */
    public function getQueryParams(): array
    {
        return $this->query_params;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }
}