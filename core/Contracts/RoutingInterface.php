<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 12:49
 */

namespace Core\Contracts;


interface RoutingInterface
{
    public function __construct();

    public function getRoutes(): array;

    public function getControllerByUri(string $uri): string;
}