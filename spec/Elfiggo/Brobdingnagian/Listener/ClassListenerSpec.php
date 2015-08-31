<?php

namespace spec\Elfiggo\Brobdingnagian\Listener;

use Elfiggo\Brobdingnagian\Detector\Detector;
use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\LoggerHandler;
use Elfiggo\Brobdingnagian\Report\Reporter;
use PhpSpec\Event\SpecificationEvent;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;


class ClassListenerSpec extends ObjectBehavior
{
    function let(Detector $detector, Params $params, Reporter $reporter, LoggerHandler $loggerHandler)
    {
        $this->beConstructedWith($detector, $params, $reporter, $loggerHandler);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Listener\ClassListener');
    }

    function it_should_implement_the_event_subscriber_interface()
    {
        $this->shouldHaveType('Symfony\Component\EventDispatcher\EventSubscriberInterface');
    }

    function it_should_call_check_size_when_before_specification_runs(SpecificationEvent $specificationEvent, Detector $detector, Params $params, Reporter $reporter)
    {
        $this->performBrobdingnagian($specificationEvent, $params, $reporter);
        $detector->analyse($specificationEvent, $params, $reporter)->shouldHaveBeenCalled();
    }
}
