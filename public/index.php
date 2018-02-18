<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 11:53
 */

require __DIR__ . '/../vendor/autoload.php';


$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

try {

    $code = \Core\Factories\CoreFactory::create();
    $code->init();

} catch (Exception $e) {
    $whoops->handleException($e);
}
