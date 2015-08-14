<?php

namespace spec\Elfiggo\Brobdingnagian;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ExtensionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Extension');
    }

    function it_should_implement_the_extension_interface()
    {
        $this->shouldHaveType('PhpSpec\Extension\ExtensionInterface');
    }
}
