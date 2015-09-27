<?php

namespace spec\Elfiggo\Brobdingnagian\Exception;

use PhpSpec\Exception\Exception;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TooManyTraitsDetectedSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Exception\TooManyTraitsDetected');
        $this->shouldHaveType(Exception::class);
    }
}
