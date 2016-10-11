<?php

namespace spec\Elfiggo\Brobdingnagian\Report;

use PhpSpec\Console\IO;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use ReflectionClass;

class LoggerHandlerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Report\LoggerHandler');
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Report\HandlerInterface');
    }

    function it_should_return_an_array_of_messages(ReflectionClass $sus)
    {
        $sus->getName()->willReturn('LargeClass');
        $this->act($sus, 'Elfiggo\Brobdingnagian\Detector\ClassSize', 'Error 1 class size is too large (1)', 'Class size');

        $sus->getName()->willReturn('SmallMethod');
        $this->act($sus, 'Elfiggo\Brobdingnagian\Detector\MethodSize', 'Method size', 'Method size');

        $sus->getName()->willReturn('DependenciesAreUs');
        $this->act($sus, 'Elfiggo\Brobdingnagian\Detector\DependenciesSize', 'Dependencies Size', 'Dependencies size');

        $sus->getName()->willReturn('LargeClass');
        $this->act($sus, 'Elfiggo\Brobdingnagian\Detector\ClassSize', 'Error 4 class size is too large (4)', 'Class size');

        $recordedMessages = [
            'LargeClass' => [
                ['message' => 'Error 1 class size is too large (1)', 'class' => 'Elfiggo\Brobdingnagian\Detector\ClassSize', 'errorType' => 'Class size'],
                ['message' => 'Error 4 class size is too large (4)', 'class' => 'Elfiggo\Brobdingnagian\Detector\ClassSize', 'errorType' => 'Class size']
            ],
            'SmallMethod' => [
                ['message' => 'Method size', 'class' => 'Elfiggo\Brobdingnagian\Detector\MethodSize', 'errorType' => 'Method size']
            ],
            'DependenciesAreUs' => [
                ['message' => 'Dependencies Size', 'class' => 'Elfiggo\Brobdingnagian\Detector\DependenciesSize', 'errorType' => 'Dependencies size']
            ],
        ];

         $this->messages()->shouldBe($recordedMessages);
    }
}
