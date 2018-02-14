<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 13:35
 */

if (!function_exists('base_path')) {
    function base_path()
    {
        return __DIR__ . '/../..';
    }
}

if (!function_exists('app_path')) {
    function app_path()
    {
        return base_path() . '/app';
    }
}

if (!function_exists('config_path')) {
    function config_path()
    {
        return app_path() . '/config';
    }
}

if (!function_exists('views_path')) {
    function views_path()
    {
        return app_path() . '/views';
    }
}