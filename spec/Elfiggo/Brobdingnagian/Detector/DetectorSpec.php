<?php

namespace spec\Elfiggo\Brobdingnagian\Detector;

use DateTime;
use Elfiggo\Brobdingnagian\Detector\ClassSize;
use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\Reporter;
use PhpSpec\Event\SpecificationEvent;
use PhpSpec\Loader\Node\SpecificationNode;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;


class DetectorSpec extends ObjectBehavior
{
    private $detections = [];

    function let()
    {
        $this->beConstructedWith($this->detections);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Detector\Detector');
    }

    function it_should_not_throw_an_error_on_construction(ClassSize $classSize)
    {
        $this->detections = [$classSize];
        $this->beConstructedWith($this->detections);
    }

    function it_should_throw_an_error_on_construction(ClassSize $classSize, DateTime $dateTime)
    {
        $this->detections = [$classSize, $dateTime];
        $this->shouldThrow('PhpSpec\Exception\Fracture\InterfaceNotImplementedException')->during__construct($this->detections);
    }

    function it_should_analyse_the_class_size(SpecificationEvent $specificationEvent, SpecificationNode $specificationNode, Params $params, Reporter $reporter)
    {
        $specificationEvent->getSpecification()->willReturn($specificationNode);
        $specificationNode->getTitle()->willReturn('Elfiggo\Brobdingnagian\Detector\ClassSize');
        $this->shouldNotThrow('Elfiggo\Brobdingnagian\Exception\ClassSizeTooLarge');
        $params->getClassSize()->willReturn(200);
        $params->getDependenciesLimit()->willReturn(2);
        $params->getNumberOfMethods()->willReturn(5);
        $params->getMethodSize()->willReturn(10);
        $this->analyse($specificationEvent, $params, $reporter);
    }

    function it_should_analyse_the_dependencies_size(SpecificationEvent $specificationEvent, SpecificationNode $specificationNode, Params $params, Reporter $reporter)
    {
        $specificationEvent->getSpecification()->willReturn($specificationNode);
        $specificationNode->getTitle()->willReturn('Elfiggo\Brobdingnagian\Detector\ClassSize');
        $this->shouldNotThrow('Elfiggo\Brobdingnagian\Exception\DependenciesSizeTooLarge');
        $params->getClassSize()->willReturn(200);
        $params->getDependenciesLimit()->willReturn(2);
        $params->getNumberOfMethods()->willReturn(5);
        $params->getMethodSize()->willReturn(10);
        $this->analyse($specificationEvent, $params, $reporter);
    }

    function it_should_analyse_the_number_of_methods_size(SpecificationEvent $specificationEvent, SpecificationNode $specificationNode, Params $params, Reporter $reporter)
    {
        $specificationEvent->getSpecification()->willReturn($specificationNode);
        $specificationNode->getTitle()->willReturn('Elfiggo\Brobdingnagian\Detector\ClassSize');
        $this->shouldNotThrow('Elfiggo\Brobdingnagian\Exception\TooManyMethodsDetected');
        $params->getClassSize()->willReturn(200);
        $params->getDependenciesLimit()->willReturn(2);
        $params->getNumberOfMethods()->willReturn(5);
        $params->getMethodSize()->willReturn(10);
        $this->analyse($specificationEvent, $params, $reporter);
    }

}
