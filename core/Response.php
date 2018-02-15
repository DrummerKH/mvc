<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 14:23
 */

namespace Core;


use Core\Contracts\AbstractResponse;

class Response extends AbstractResponse
{
    private $layout = '';

    private $headers = [];

    private $response_code = 200;

    protected $main_layout = 'layouts/main.php';

    /**
     * @param int $response_code
     * @return Response
     */
    public function setResponseCode(int $response_code): Response
    {
        $this->response_code = $response_code;
        return $this;
    }

    /**
     * @param string $view
     * @param array $parameters
     * @return Response
     */
    public function render(string $view, array $parameters = []): Response
    {
        $content = $this->loadView("$view.php", $parameters);
        $this->layout = $this->loadView($this->main_layout, array_merge($parameters, ['content' => $content]));
        return $this;
    }

    /**
     * @param string $view_file
     * @param array $parameters
     * @return string
     */
    protected function loadView(string $view_file, array $parameters = []): string
    {
        extract($parameters);

        ob_start();
            include \views_path() . "/$view_file";

        return ob_get_clean();
    }

    /**
     * @param string $name
     * @param string $value
     * @return AbstractResponse
     */
    public function setHeader(string $name, string $value)
    {
        $this->headers[$name] = $value;
        return $this;
    }

    /**
     * @param $uri
     * @param int $code
     */
    public function redirect(string $uri, int $code = 301): void
    {
        header( "Location: $uri", true, $code);
        exit;
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