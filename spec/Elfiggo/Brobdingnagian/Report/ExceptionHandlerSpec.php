<?php

namespace spec\Elfiggo\Brobdingnagian\Report;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use ReflectionClass;

class ExceptionHandlerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Report\ExceptionHandler');
    }

    function it_should_implement_the_handler_interface()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Report\Handler');
    }

    function it_should_throw_a_class_size_exception(ReflectionClass $sus)
    {
        $this->shouldThrow('\Elfiggo\Brobdingnagian\Exception\ClassSizeTooLarge')->duringAct($sus, 'Elfiggo\Brobdingnagian\Detector\ClassSize', 'Class size');
    }
}
