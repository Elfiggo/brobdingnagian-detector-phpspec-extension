<?php

namespace spec\Elfiggo\Brobdingnagian\Detector;

use Elfiggo\Brobdingnagian\Exception\TooManyInterfacesDetected;
use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\Reporter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use ReflectionClass;

class NumberOfInterfacesSpec extends ObjectBehavior
{
    const DEFAULT_NUMBER_OF_INTERFACES = 3;

    function it_is_initializable()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Detector\NumberOfInterfaces');
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Detector\DetectionInterface');
    }


    function it_does_not_complain_if_the_number_of_interfaces_is_not_too_large(ReflectionClass $sus, Params $params, Reporter $reporter)
    {
        $params->getNumberOfInterfaces()->willReturn(self::DEFAULT_NUMBER_OF_INTERFACES);
        $sus->getInterfaces()->willReturn(['interface 1', 'interface 2', 'interface 3']);
        $this->shouldNotThrow(TooManyInterfacesDetected::class)->duringCheck($sus, $params, $reporter);
    }

    function it_does_complain_if_the_number_of_interfaces_is_too_large(ReflectionClass $sus, Params $params, Reporter $reporter)
    {
        $params->getNumberOfInterfaces()->willReturn(self::DEFAULT_NUMBER_OF_INTERFACES);
        $sus->getInterfaces()->willReturn(['interface 1', 'interface 2', 'interface 3', 'interface 4']);
        $sus->getName()->willReturn('Enormo Class');
        $reporter->act($sus, 'Elfiggo\Brobdingnagian\Detector\NumberOfInterfaces', 'Enormo Class has too many interfaces (4)', 'Too many interfaces')->willThrow(TooManyInterfacesDetected::class);
        $this->shouldThrow(TooManyInterfacesDetected::class)->duringCheck($sus, $params, $reporter);
    }
}
