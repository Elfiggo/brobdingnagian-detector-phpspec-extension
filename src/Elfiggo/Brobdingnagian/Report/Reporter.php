<?php

namespace Elfiggo\Brobdingnagian\Report;

use Elfiggo\Brobdingnagian\Param\Params;
use ReflectionClass;

class Reporter
{

    private $handler;

    public function __construct(Params $params, LoggerHandler $loggerHandler, ExceptionHandler $exceptionHandler)
    {
        $this->handler = $params->getBrobList() ?
            $loggerHandler :
            $exceptionHandler;
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
