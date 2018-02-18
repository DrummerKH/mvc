<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 18.02.18
 * Time: 21:10
 */

namespace App\Factories;


use App\Services\Payments;
use Core\MysqlStorage;

class PaymentsFactory
{
    /**
     * @return Payments
     */
    public static function create(): Payments
    {
        return new Payments(new MysqlStorage);
    }
}