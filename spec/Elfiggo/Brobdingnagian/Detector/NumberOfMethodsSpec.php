<?php

namespace spec\Elfiggo\Brobdingnagian\Detector;

use Elfiggo\Brobdingnagian\Exception\TooManyMethodsDetected;
use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\Reporter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use ReflectionClass;

class NumberOfMethodsSpec extends ObjectBehavior
{
    const DEFAULT_NUMBER_OF_METHODS = 5;

    function let(ReflectionClass $sus, Params $params, Reporter $reporter)
    {
        $this->beConstructedWith($sus, $params, $reporter);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Detector\NumberOfMethods');
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Detector\Detection');
    }

    function it_does_not_complain_if_the_number_of_methods_is_not_too_large(ReflectionClass $sus, Params $params)
    {
        $params->getNumberOfMethods()->willReturn(self::DEFAULT_NUMBER_OF_METHODS);
        $sus->getMethods()->willReturn(3);
        $this->shouldNotThrow(TooManyMethodsDetected::class)->duringCheck();
    }

    function it_does_complain_if_the_number_of_methods_is_too_large(ReflectionClass $sus, Params $params, Reporter $reporter)
    {
        $params->getNumberOfMethods()->willReturn(1);
        $sus->getMethods()->willReturn(['method 1', 'method 2']);
        $sus->getName()->willReturn('Enormo Class');
        $reporter->act($sus, 'Elfiggo\Brobdingnagian\Detector\NumberOfMethods', 'Enormo Class has too many methods (2)')->willThrow(TooManyMethodsDetected::class);
        $this->shouldThrow(TooManyMethodsDetected::class)->duringCheck();
    }
}
