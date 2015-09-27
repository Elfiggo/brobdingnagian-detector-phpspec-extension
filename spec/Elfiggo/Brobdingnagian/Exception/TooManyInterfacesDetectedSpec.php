<?php

namespace spec\Elfiggo\Brobdingnagian\Exception;

use PhpSpec\Exception\Exception;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TooManyInterfacesDetectedSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Exception\TooManyInterfacesDetected');
        $this->shouldHaveType(Exception::class);
    }
}
