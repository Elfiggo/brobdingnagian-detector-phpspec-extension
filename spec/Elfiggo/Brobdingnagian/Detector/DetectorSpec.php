<?php

namespace spec\Elfiggo\Brobdingnagian\Detector;

use Elfiggo\Brobdingnagian\Detector\ClassSize;
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

    function it_should_analyse_the_class_size(SpecificationEvent $specificationEvent, SpecificationNode $specificationNode)
    {
        $specificationEvent->getSpecification()->willReturn($specificationNode);
        $specificationNode->getClassReflection()->willReturn(new \ReflectionClass(ClassSize::class));
        $this->shouldNotThrow('Elfiggo\Brobdingnagian\Exception\ClassSizeTooLarge');
        $this->analyse($specificationEvent);
    }

}
