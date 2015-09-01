<?php

namespace spec\Elfiggo\Brobdingnagian\Report;

use PhpSpec\Console\IO;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use ReflectionClass;

class LoggerHandlerSpec extends ObjectBehavior
{
    function let(IO $io)
    {
        $this->beConstructedWith($io);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Report\LoggerHandler');
    }

    function it_should_implement_the_handler_interface()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Report\Handler');
    }

    function it_should_return_an_array_of_messages(ReflectionClass $sus)
    {
        $sus->getEndLine()->willReturn(1);
        $sus->getName()->willReturn('Error 1');
        $this->act($sus, 'ClassSize', 'Class size');

        $sus->getEndLine()->willReturn(2);
        $sus->getName()->willReturn('Error 2');
        $this->act($sus, 'MethodSize', 'Method size');

        $sus->getEndLine()->willReturn(3);
        $sus->getName()->willReturn('Error 3');
        $this->act($sus, 'DependenciesSize', 'Dependencies Size');

        $sus->getEndLine()->willReturn(4);
        $sus->getName()->willReturn('Error 4');
        $this->act($sus, 'ClassSize', 'Class size');

        $recordedMessages = [
            ['message' => 'Error 1 (1)', 'class' => 'ClassSize', 'errorType' => 'Class size'],
            ['message' => 'Error 2 (2)', 'class' => 'MethodSize', 'errorType' => 'Method size'],
            ['message' => 'Error 3 (3)', 'class' => 'DependenciesSize', 'errorType' => 'Dependencies Size'],
            ['message' => 'Error 4 (4)', 'class' => 'ClassSize', 'errorType' => 'Class size'],
        ];

        $this->messages()->shouldReturn($recordedMessages);
    }
}
