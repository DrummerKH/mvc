<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 12:18
 */

namespace Core;

use Core\Contracts\AbstractRequest;

class Request extends AbstractRequest
{
    /**
     * Request constructor
     */
    public function __construct()
    {
        $this->configure();
    }

    protected function configure(): void
    {
        # Getting parts of uri
        $this->path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        $path = explode('/', $this->path);

        $this->controller = $path[0] ?: '/';
        $this->method = isset($path[1]) ? $path[1] : '';

        $this->query_params = $_GET;
        $this->post = $_POST;

        $this->http_method = $_SERVER['REQUEST_METHOD'];
    }
}