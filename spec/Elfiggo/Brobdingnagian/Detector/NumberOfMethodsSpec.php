<?php

namespace spec\Elfiggo\Brobdingnagian\Detector;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use ReflectionClass;

class NumberOfMethodsSpec extends ObjectBehavior
{
    function let(ReflectionClass $sus)
    {
        $this->beConstructedWith($sus);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Detector\NumberOfMethods');
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Detector\Detection');
    }
}
