<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 13:01
 */

namespace Core\Contracts;


abstract class AbstractRequest
{
    /**
     * URI of request
     * @var string
     */
    protected $uri;

    /**
     * Array of GET parameters
     * @var array
     */
    protected $query_params;

    /**
     * Array of URI parts
     * @var array
     */
    protected $path;

    /**
     * Requested controller name
     * @var string
     */
    protected $controller;

    /**
     * Requested method
     * @var string
     */
    protected $method;

    /**
     * Array of POST parameters
     * @var array
     */
    protected $post;

    /**
     * HTTP method
     * @var string
     */
    protected $http_method;

    /**
     * Configure instance
     * @return void
     */
    abstract protected function configure(): void;

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @param string $key
     * @param string $default
     * @return string
     */
    public function getQueryParam(string $key, string $default = ''): string
    {
        return isset($this->query_params[$key]) ? $this->query_params[$key] : $default;
    }

    /**
     * @return array
     */
    public function getPath(): array
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

    /**
     * @param string $key
     * @param string $default
     * @return string
     */
    public function getPost(string $key, string $default = ''): string
    {
        return isset($this->post[$key]) ? $this->post[$key] : $default;
    }

    /**
     * @return bool
     */
    public function isPost(): bool
    {
        return $this->http_method == 'POST';
    }

    /**
     * @return bool
     */
    public function isGet(): bool
    {
        return $this->http_method == 'GET';
    }

    /**
     * @return bool
     */
    public function isPut(): bool
    {
        return $this->http_method == 'PUT';
    }

    /**
     * @return bool
     */
    public function isDelete(): bool
    {
        return $this->http_method == 'DELETE';
    }
}