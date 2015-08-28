<?php

namespace spec\Elfiggo\Brobdingnagian\Detector;

use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\Reporter;
use PhpSpec\Event\SpecificationEvent;
use PhpSpec\Loader\Node\SpecificationNode;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;


class DetectorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Detector\Detector');
    }

    function it_should_analyse_the_class_size(SpecificationEvent $specificationEvent, SpecificationNode $specificationNode, Params $params, Reporter $reporter)
    {
        $specificationEvent->getSpecification()->willReturn($specificationNode);
        $specificationNode->getTitle()->willReturn('Elfiggo\Brobdingnagian\Detector\ClassSize');
        $this->shouldNotThrow('Elfiggo\Brobdingnagian\Exception\ClassSizeTooLarge');
        $this->shouldNotThrow('Elfiggo\Brobdingnagian\Exception\DependenciesSizeTooLarge');
        $params->getClassSize()->willReturn(200);
        $params->getDependenciesLimit()->willReturn(2);
        $this->analyse($specificationEvent, $params, $reporter);
    }

}
