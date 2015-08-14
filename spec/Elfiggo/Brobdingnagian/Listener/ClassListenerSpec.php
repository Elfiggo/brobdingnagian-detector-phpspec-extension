<?php

namespace spec\Elfiggo\Brobdingnagian\Listener;

use Elfiggo\Brobdingnagian\Detector\Detector;
use PhpSpec\Event\SpecificationEvent;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClassListenerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Listener\ClassListener');
    }

    function it_should_implement_the_event_subscriber_interface()
    {
        $this->shouldHaveType('Symfony\Component\EventDispatcher\EventSubscriberInterface');
    }

    function it_should_call_check_size_when_before_example_runs(SpecificationEvent $specificationEvent, Detector $detector)
    {
        $this->performBrobdingnagian($specificationEvent, $detector);
        $detector->analyse($specificationEvent)->shouldHaveBeenCalled();
    }
}
