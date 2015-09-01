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
        $this->act($sus, 'ClassSize', 'Error 1 class size is too large (1)');
        $this->act($sus, 'MethodSize', 'Method size');
        $this->act($sus, 'DependenciesSize', 'Dependencies Size');
        $this->act($sus, 'ClassSize', 'Error 4 class size is too large (4)');

        $recordedMessages = [
            ['message' => 'Error 1 class size is too large (1)', 'class' => 'ClassSize', 'errorType' => null],
            ['message' => 'Method size', 'class' => 'MethodSize', 'errorType' => null],
            ['message' => 'Dependencies Size', 'class' => 'DependenciesSize', 'errorType' => null],
            ['message' => 'Error 4 class size is too large (4)', 'class' => 'ClassSize', 'errorType' => null],
        ];

         $this->messages()->shouldBe($recordedMessages);
    }
}
