<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 11:53
 */

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/core/Helpers/PathsHelper.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$request = \Core\Request::getInstance();
$response = \Core\Response::getInstance();


$core = new \Core\Core();

$core->init(new \Core\Routing, $request, $response);
