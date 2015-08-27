<?php

namespace Elfiggo\Brobdingnagian\Report;

use Elfiggo\Brobdingnagian\Param\Params;

class Reporter implements Handler
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

    public function act($string, $class)
    {
        $this->handler->act($string, $class);
    }
}
