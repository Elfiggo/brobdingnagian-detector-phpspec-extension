<?php

namespace spec\Elfiggo\Brobdingnagian\Detector;

use Elfiggo\Brobdingnagian\Exception\TooManyTraitsDetected;
use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\Reporter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use ReflectionClass;

class NumberOfTraitsSpec extends ObjectBehavior
{
    const DEFAULT_NUMBER_OF_TRAITS = 1;

    function it_is_initializable()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Detector\NumberOfTraits');
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Detector\DetectionInterface');
    }

    function it_does_not_complain_if_the_number_of_traits_is_not_too_large(ReflectionClass $sus, Params $params, Reporter $reporter)
    {
        $params->getNumberOfTraits()->willReturn(self::DEFAULT_NUMBER_OF_TRAITS);
        $sus->getTraits()->willReturn([]);
        $this->shouldNotThrow(TooManyTraitsDetected::class)->duringCheck($sus, $params, $reporter);
    }

    function it_does_complain_if_the_number_of_traits_is_too_large(ReflectionClass $sus, Params $params, Reporter $reporter)
    {
        $params->getNumberOfTraits()->willReturn(self::DEFAULT_NUMBER_OF_TRAITS);
        $sus->getTraits()->willReturn(['trait 1', 'trait 2', 'trait 3', 'trait 4']);
        $sus->getName()->willReturn('Enormo Class');
        $reporter->act($sus, 'Elfiggo\Brobdingnagian\Detector\NumberOfTraits', 'Enormo Class has too many traits (4)', 'Too many traits')->willThrow(TooManyTraitsDetected::class);
        $this->shouldThrow(TooManyTraitsDetected::class)->duringCheck($sus, $params, $reporter);
    }
}
