<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 14:23
 */

namespace Core;


use Core\Contracts\ResponseInterface;

class Response implements ResponseInterface
{
    private static $instance;
    private $layout = '';

    private $headers = [];

    private $response_code = 200;

    protected $main_layout = 'layouts/main.php';

    private function __construct(){}
    private function __clone(){}

    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * @param int $response_code
     * @return Response
     */
    public function setResponseCode(int $response_code)
    {
        $this->response_code = $response_code;
        return $this;
    }

    /**
     * @param string $view
     * @param array $parameters
     * @return $this
     */
    public function render(string $view, array $parameters = [])
    {
        $content = $this->load_view("$view.php", $parameters);
        $this->layout = $this->load_view($this->main_layout, ['content' => $content]);
        return $this;
    }

    /**
     * @param string $view_file
     * @param array $parameters
     * @return string
     */
    protected function load_view(string $view_file, array $parameters = [])
    {
        extract($parameters);

        ob_start();

        include \views_path() . "/$view_file";

        return ob_get_clean();
    }

    /**
     * @param string $name
     * @param string $value
     * @return Response
     */
    public function setHeader(string $name, string $value)
    {
        $this->headers[$name] = $value;
        return $this;
    }

    /**
     *
     */
    public function __destruct()
    {
        http_response_code($this->response_code);

        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }

        exit($this->layout);
    }
}