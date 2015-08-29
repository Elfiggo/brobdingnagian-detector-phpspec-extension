<?php

namespace Elfiggo\Brobdingnagian\Report;

use Elfiggo\Brobdingnagian\Param\Params;
use ReflectionClass;

class Reporter
{

    private $handler;

    public function __construct(Params $params)
    {
        $this->handler = $params->getBrobList() ?
            new LoggerHandler() :
            new ExceptionHandler();
    }

    public function handlerType()
    {
        return get_class($this->handler);
    }

    public function act(ReflectionClass $sus, $class, $errorType)
    {
        $this->handler->act($sus, $class, $errorType);
    }
}
