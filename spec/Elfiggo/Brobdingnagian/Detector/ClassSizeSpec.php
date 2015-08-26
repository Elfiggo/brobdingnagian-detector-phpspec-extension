<?php

namespace spec\Elfiggo\Brobdingnagian\Detector;

use Elfiggo\Brobdingnagian\Exception\ClassSizeTooLarge;
use Elfiggo\Brobdingnagian\Param\Params;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use ReflectionClass;

class ClassSizeSpec extends ObjectBehavior
{
    const LESS_THAN_300 = 299;
    const GREATER_THAN_300 = 301;

    function let(ReflectionClass $sus, Params $params)
    {
        $this->beConstructedWith($sus, $params);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Detector\ClassSize');
    }

    function it_does_not_complain_if_the_class_size_is_not_too_large(ReflectionClass $sus, Params $params)
    {
        $params->getClassSize()->willReturn(self::LESS_THAN_300);
        $sus->getEndLine()->willReturn(self::LESS_THAN_300);
        $this->check();
    }

    function it_complains_if_class_size_is_too_large(ReflectionClass $sus, Params $params)
    {
        $sus->getEndLine()->willReturn(self::GREATER_THAN_300);
        $params->getClassSize()->willReturn(self::LESS_THAN_300);
        $sus->getName()->willReturn("Elfiggo/Brobdingnagian/Detector/ClassSize");
        $this->shouldThrow(ClassSizeTooLarge::class)->duringCheck();
    }
}
