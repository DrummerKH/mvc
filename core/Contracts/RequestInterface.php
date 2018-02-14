<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 13:01
 */

namespace Core\Contracts;


interface RequestInterface
{
    public static function getInstance();

    public function getUri(): string;

    public function getController(): string;

    public function getMethod(): string;

    public function getPath(): string;

    public function getQueryParams(): array;
}