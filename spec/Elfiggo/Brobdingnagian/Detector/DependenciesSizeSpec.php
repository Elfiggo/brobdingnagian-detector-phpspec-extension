<?php

namespace spec\Elfiggo\Brobdingnagian\Detector;

use Elfiggo\Brobdingnagian\Exception\DependenciesSizeTooLarge;
use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\Reporter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use ReflectionClass;
use ReflectionMethod;

class DependenciesSizeSpec extends ObjectBehavior
{
    const DEPENDENCIES_LIMIT = 3;

    function let(ReflectionClass $sus, Params $params, Reporter $reporter, ReflectionMethod $reflectionMethod)
    {
        $reflectionMethod->getNumberOfParameters()->willReturn(7);
        $sus->getMethods()->willReturn([$reflectionMethod]);

        $this->beConstructedWith($sus, $params, $reporter);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Detector\DependenciesSize');
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Detector\Detection');
    }

    function it_does_not_complain_if_the_number_of_dependencies_are_low(ReflectionClass $sus, Params $params, Reporter $reporter, ReflectionMethod $reflectionMethod)
    {
        $reflectionMethod->getNumberOfParameters()->willReturn(2);
        $params->getDependenciesLimit()->willReturn(self::DEPENDENCIES_LIMIT);
        $reporter->act($sus, self::class, 'Dependencies size')->shouldNotBeCalled();
        $this->shouldNotThrow(DependenciesSizeTooLarge::class)->duringCheck();
    }

    function it_complains_if_the_number_of_dependencies_are_high(ReflectionClass $sus, Params $params, Reporter $reporter, ReflectionMethod $reflectionMethod)
    {
        $params->getDependenciesLimit()->willReturn(self::DEPENDENCIES_LIMIT);
        $sus->getName()->willReturn("Elfiggo/Brobdingnagian/Detector/DependenciesSize");

        $reflectionMethod->getName()->willReturn('random_method');
        $reflectionMethod->getNumberOfParameters()->willReturn(20);

        $sus->getMethods()->willReturn([$reflectionMethod]);
        $reporter->act($sus, 'Elfiggo\Brobdingnagian\Detector\DependenciesSize', 'random_method has too many dependencies (20)')->willThrow(DependenciesSizeTooLarge::class);
        $this->shouldThrow(DependenciesSizeTooLarge::class)->duringCheck();
    }
}
