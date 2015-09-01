<?php

namespace spec\Elfiggo\Brobdingnagian\Report;

use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\ExceptionHandler;
use Elfiggo\Brobdingnagian\Report\LoggerHandler;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ReporterSpec extends ObjectBehavior
{
    function let(Params $params, LoggerHandler $loggerHandler, ExceptionHandler $exceptionHandler)
    {
        $this->beConstructedWith($params, $loggerHandler, $exceptionHandler);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Report\Reporter');
    }

    function it_should_return_exception_handler_for_false(Params $params, ExceptionHandler $exceptionHandler)
    {
        $params->getBrobList()->willReturn(false);
        $this->handlerType()->shouldReturn(get_class($exceptionHandler->getWrappedObject()));
    }

    function it_should_return_logger_handler_for_true(Params $params, LoggerHandler $loggerHandler)
    {
        $params->getBrobList()->willReturn(true);
        $this->handlerType()->shouldReturn(get_class($loggerHandler->getWrappedObject()));
    }

}
