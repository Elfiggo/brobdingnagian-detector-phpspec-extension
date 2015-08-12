<?php

namespace spec\Elfiggo\Brobdingnagian\Exception;

use PhpSpec\Exception\Exception;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClassSizeTooLargeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Exception::class);
    }
}
