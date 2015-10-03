<?php

namespace spec\Elfiggo\Brobdingnagian\Report;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use ReflectionClass;

class ExceptionHandlerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Report\HandlerInterface');
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Report\ExceptionHandler');
    }

    function it_should_implement_the_handler_interface()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Report\HandlerInterface');
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Report\Handler');
    }

    function it_should_throw_a_class_size_exception(ReflectionClass $sus)
    {
        $this->shouldThrow('\Elfiggo\Brobdingnagian\Exception\ClassSizeTooLarge')->duringAct($sus, 'Elfiggo\Brobdingnagian\Detector\ClassSize', 'Class size');
    }

    function it_should_throw_a_dependencies_size_exception(ReflectionClass $sus)
    {
        $this->shouldThrow('\Elfiggo\Brobdingnagian\Exception\DependenciesSizeTooLarge')->duringAct($sus, 'Elfiggo\Brobdingnagian\Detector\DependenciesSize', 'Dependencies size');
    }

    function it_should_throw_a_method_size_exception(ReflectionClass $sus)
    {
        $this->shouldThrow('\Elfiggo\Brobdingnagian\Exception\MethodSizeTooLarge')->duringAct($sus, 'Elfiggo\Brobdingnagian\Detector\MethodSize', 'Method size');
    }

    function it_should_throw_a_number_of_method_exception(ReflectionClass $sus)
    {
        $this->shouldThrow('\Elfiggo\Brobdingnagian\Exception\TooManyMethodsDetected')->duringAct($sus, 'Elfiggo\Brobdingnagian\Detector\NumberOfMethods', 'Detected method size');
    }

    function it_should_throw_a_number_of_interfaces_exception(ReflectionClass $sus)
    {
        $this->shouldThrow('\Elfiggo\Brobdingnagian\Exception\TooManyInterfacesDetected')->duringAct($sus, 'Elfiggo\Brobdingnagian\Detector\NumberOfInterfaces', 'Detected interfaces size');
    }
}
