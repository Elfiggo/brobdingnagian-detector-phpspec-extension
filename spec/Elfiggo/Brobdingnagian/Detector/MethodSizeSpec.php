<?php

namespace spec\Elfiggo\Brobdingnagian\Detector;

use Elfiggo\Brobdingnagian\Exception\MethodSizeTooLarge;
use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\Reporter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use ReflectionClass;
use ReflectionMethod;


class MethodSizeSpec extends ObjectBehavior
{
    const LESS_THAN_15 = 14;
    const GREATER_THAN_20 = 21;
    const START_LINE = 5;
    const END_LINE = 45;

    function let(ReflectionClass $sus, Params $params, Reporter $reporter)
    {
        $this->beConstructedWith($sus, $params, $reporter);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Detector\MethodSize');
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Detector\Detection');
    }

    function it_does_not_complain_about_method_size(ReflectionClass $sus, Params $params, ReflectionMethod $method)
    {
        $method->getEndLine()->willReturn(self::LESS_THAN_15);
        $method->getStartLine()->willReturn(0);
        $method->getName()->willReturn('method_size');

        $sus->getMethods()->willReturn([$method]);
        $params->getMethodSize()->willReturn(15);

        $this->shouldNotThrow(MethodSizeTooLarge::class)->duringCheck();
    }

    function it_should_throw_method_size_too_large_during_check(ReflectionClass $sus, Params $params, ReflectionMethod $method, ReflectionMethod $method2, Reporter $reporter)
    {
        $method->getStartLine()->willReturn(0);
        $method->getEndLine()->willReturn(self::GREATER_THAN_20);
        $method->getName()->willReturn('method_size_1');

        $method2->getStartLine()->willReturn(0);
        $method2->getEndLine()->willReturn(self::GREATER_THAN_20);
        $method2->getName()->willReturn('method_size_2');

        $sus->getMethods()->willReturn([$method]);
        $reporter->act($sus, 'Elfiggo\Brobdingnagian\Detector\MethodSize', 'method_size_1 size is 21 lines long')->willThrow(MethodSizeTooLarge::class);
        $params->getMethodSize()->willReturn(15);
        $this->shouldThrow(MethodSizeTooLarge::class)->duringCheck();
    }

    function it_calculates_the_number_of_lines_in_a_method(ReflectionClass $sus, Params $params, ReflectionMethod $method, Reporter $reporter)
    {
        $method->getStartLine()->willReturn(self::START_LINE);
        $method->getEndLine()->willReturn(self::END_LINE);
        $method->getName()->willReturn('method_size_1');

        $sus->getMethods()->willReturn([$method]);
        $reporter->act($sus, 'Elfiggo\Brobdingnagian\Detector\MethodSize', 'method_size_1 size is 40 lines long')->willThrow(MethodSizeTooLarge::class);
        $params->getMethodSize()->willReturn(15);
        $this->shouldThrow(MethodSizeTooLarge::class)->duringCheck();
    }

}
