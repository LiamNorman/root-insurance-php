<?php

namespace RootAPI;

use RootAPI\Exceptions\InvalidRequestException;
use RootAPI\Interfaces\IFactory;

class RequestAbstractionFactory implements IFactory
{
    protected $instantiatedClass = null;

    public function __get($className)
    {
        return $this->createInstance($className);
    }

    public function createInstance($className)
    {
        $fullClassName = "App\\RootAPI\\Requests\\$className";
        if (class_exists($fullClassName)) {
            return new $fullClassName;
        }

        throw new InvalidRequestException('Failed to create abstract class');
    }
}