<?php

namespace spec\Elfiggo\Brobdingnagian\Listener;

use Elfiggo\Brobdingnagian\Detector\Detector;
use Elfiggo\Brobdingnagian\Param\Params;
use PhpSpec\Event\SpecificationEvent;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;


class ClassListenerSpec extends ObjectBehavior
{
    function let(Detector $detector)
    {
        $this->beConstructedWith($detector);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Listener\ClassListener');
    }

    function it_should_implement_the_event_subscriber_interface()
    {
        $this->shouldHaveType('Symfony\Component\EventDispatcher\EventSubscriberInterface');
    }

    function it_should_call_check_size_when_before_specification_runs(SpecificationEvent $specificationEvent, Detector $detector, Params $params)
    {
        $this->performBrobdingnagian($specificationEvent, $params);
        $detector->analyse($specificationEvent, $params)->shouldHaveBeenCalled();
    }
}
