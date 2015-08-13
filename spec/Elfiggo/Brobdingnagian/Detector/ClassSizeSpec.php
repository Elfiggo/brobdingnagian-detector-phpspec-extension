<?php

namespace spec\Elfiggo\Brobdingnagian\Detector;

use Elfiggo\Brobdingnagian\Exception\ClassSizeTooLarge;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use ReflectionClass;

class ClassSizeSpec extends ObjectBehavior
{
    const LESS_THAN_300 = 299;
    const GREATER_THAN_300 = 301;

    function let(ReflectionClass $sus)
    {
        $this->beConstructedWith($sus);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Detector\ClassSize');
    }

    function it_does_not_complain_if_the_class_size_is_not_too_large(ReflectionClass $sus)
    {
        $sus->getEndLine()->willReturn(self::LESS_THAN_300);
        $this->check();
    }

    function it_complains_if_class_size_is_too_large(ReflectionClass $sus)
    {
        $sus->getEndLine()->willReturn(self::GREATER_THAN_300);
        $this->shouldThrow(ClassSizeTooLarge::class)->duringCheck();
    }
}
