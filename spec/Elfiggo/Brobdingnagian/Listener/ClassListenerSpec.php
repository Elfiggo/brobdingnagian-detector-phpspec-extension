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

    function it_should_output_a_message(Params $params, LoggerHandler $loggerHandler)
    {
        $params->getBrobList()->willReturn(true);
        $loggerHandler->messages()->willReturn([1,2,3]);

        $loggerHandler->output()->shouldBeCalled();

        $this->displayErrors();
    }

    function it_should_not_output_a_message(Params $params, LoggerHandler $loggerHandler)
    {
        $params->getBrobList()->willReturn(false);
        $loggerHandler->messages()->willReturn([1,2,3]);

        $loggerHandler->output()->shouldNotBeCalled();

        $this->displayErrors();
    }

    function it_should_generate_csv(Params $params, LoggerHandler $loggerHandler)
    {
        $params->getCsv()->willReturn(true);
        $loggerHandler->csvOutput()->shouldBeCalled();

        $this->generateCsv();
    }

    function it_should_not_generate_csv(Params $params, LoggerHandler $loggerHandler)
    {
        $params->getCsv()->willReturn(false);
        $loggerHandler->csvOutput()->shouldNotBeCalled();

        $this->generateCsv();
    }

    function it_should_return_array()
    {
        self::getSubscribedEvents()->shouldHaveCount(2);
    }
}
