<?php
/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 18:16
 */

namespace Core\Contracts;


abstract class AbstractRepository
{
    /**
     * Storage instance
     * @var AbstractStorageManager
     */
    public $storage;

    public function __construct(AbstractStorageManager $storage)
    {
        $this->storage = $storage;
    }
}