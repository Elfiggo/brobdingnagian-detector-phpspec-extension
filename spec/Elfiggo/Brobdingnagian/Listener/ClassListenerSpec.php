<?php

namespace spec\Elfiggo\Brobdingnagian\Listener;

use Elfiggo\Brobdingnagian\Detector\Detector;
use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\Reporter;
use PhpSpec\Console\IO;
use PhpSpec\Event\SpecificationEvent;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;


class ClassListenerSpec extends ObjectBehavior
{
    function let(Detector $detector, Params $params, Reporter $reporter, IO $io)
    {
        $this->beConstructedWith($detector, $params, $reporter, $io);
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

    function it_should_output_a_message(Params $params, Reporter $reporter, IO $io)
    {
        $params->getBrobList()->willReturn(true);

        $reporter->output($io)->shouldBeCalled();

        $this->displayErrors();
    }

    function it_should_not_output_a_message(Params $params, Reporter $reporter, IO $io)
    {
        $params->getBrobList()->willReturn(false);

        $reporter->output($io)->shouldNotBeCalled();

        $this->displayErrors();
    }

    function it_should_generate_csv(Params $params, Reporter $reporter)
    {
        $params->getCsv()->willReturn(true);
        $reporter->csvOutput()->shouldBeCalled();

        $this->generateCsv();
    }

    function it_should_not_generate_csv(Params $params, Reporter $reporter)
    {
        $params->getCsv()->willReturn(false);
        $reporter->csvOutput()->shouldNotBeCalled();

        $this->generateCsv();
    }

    function it_should_return_array()
    {
        self::getSubscribedEvents()->shouldHaveCount(2);
    }
}
