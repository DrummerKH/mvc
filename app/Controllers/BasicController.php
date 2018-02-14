<?php

namespace App\Controllers;

use Core\Contracts\RequestInterface;
use Core\Contracts\ResponseInterface;

/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 12:04
 */

class BasicController
{
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        $response
            ->render('index',
                ['var' => $request->getQueryParams()]
            );
    }
}