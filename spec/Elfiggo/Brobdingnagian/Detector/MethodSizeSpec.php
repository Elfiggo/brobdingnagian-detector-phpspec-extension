<?php

namespace spec\Elfiggo\Brobdingnagian\Detector;

use Elfiggo\Brobdingnagian\Exception\MethodSizeTooLarge;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use ReflectionMethod;


class MethodSizeSpec extends ObjectBehavior
{
    const LESS_THAN_20 = 19;
    const GREATER_THAN_20 = 21;
    const START_LINE = 5;
    const END_LINE = 45;

    function let(ReflectionMethod $sus)
    {
        $this->beConstructedWith($sus);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Detector\MethodSize');
    }

    function it_does_not_complain_about_method_size(ReflectionMethod $sus)
    {
        $sus->getStartLine()->willReturn(0);
        $sus->getEndLine()->willReturn(self::LESS_THAN_20);
        $this->shouldNotThrow(MethodSizeTooLarge::class)->duringCheck();
    }

    function it_should_throw_method_size_too_large_during_check(ReflectionMethod $sus)
    {
        $sus->getStartLine()->willReturn(0);
        $sus->getEndLine()->willReturn(self::GREATER_THAN_20);
        $this->shouldThrow(MethodSizeTooLarge::class)->duringCheck();
    }

    function it_calculates_the_number_of_lines_in_a_method(ReflectionMethod $sus)
    {
        $sus->getStartLine()->willReturn(self::START_LINE);
        $sus->getEndLine()->willReturn(self::END_LINE);
        $this->shouldThrow(MethodSizeTooLarge::class)->duringCheck();
    }

}
