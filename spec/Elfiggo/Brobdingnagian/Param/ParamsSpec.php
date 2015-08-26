<?php

namespace spec\Elfiggo\Brobdingnagian\Param;

use PhpSpec\ObjectBehavior;
use PhpSpec\ServiceContainer;
use Prophecy\Argument;

class ParamsSpec extends ObjectBehavior
{
    function let(ServiceContainer $serviceContainer)
    {
        $serviceContainer->getParam('brobdingnagian')->willReturn(array('class_size' => 200));
        $this->beConstructedWith($serviceContainer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Param\Params');
    }

    function it_returns_the_default_class_size(ServiceContainer $serviceContainer)
    {
        $serviceContainer->getParam('brobdingnagian')->willReturn(null);
        $this->getClassSize()->shouldReturn(300);
    }

    function it_should_return_a_custom_size()
    {
        $this->getClassSize()->shouldReturn(200);
    }
}
