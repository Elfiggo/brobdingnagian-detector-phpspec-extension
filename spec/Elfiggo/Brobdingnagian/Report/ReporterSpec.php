<?php

namespace spec\Elfiggo\Brobdingnagian\Report;

use Elfiggo\Brobdingnagian\Param\Params;
use PhpSpec\Console\IO;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ReporterSpec extends ObjectBehavior
{
    function let(Params $params, IO $io)
    {
        $this->beConstructedWith($params, $io);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Report\Reporter');
    }

    function it_should_return_exception_handler_for_false(Params $params)
    {
        $params->getBrobList()->willReturn(false);
        $this->handlerType()->shouldReturn('Elfiggo\Brobdingnagian\Report\ExceptionHandler');
    }

    function it_should_return_logger_handler_for_true(Params $params)
    {
        $params->getBrobList()->willReturn(true);
        $this->handlerType()->shouldReturn('Elfiggo\Brobdingnagian\Report\LoggerHandler');
    }

}
