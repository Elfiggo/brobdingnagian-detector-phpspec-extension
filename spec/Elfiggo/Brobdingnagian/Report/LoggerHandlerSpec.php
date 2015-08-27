<?php

namespace spec\Elfiggo\Brobdingnagian\Report;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LoggerHandlerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Report\LoggerHandler');
    }

    function it_should_implement_the_handler_interface()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Report\Handler');
    }
}
