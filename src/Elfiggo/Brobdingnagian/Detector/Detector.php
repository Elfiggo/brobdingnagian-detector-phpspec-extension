<?php

namespace Elfiggo\Brobdingnagian\Detector;


use PhpSpec\Event\SpecificationEvent;
use ReflectionClass;

class Detector
{
    /**
     * @var ReflectionClass
     */
    private $sus;

    /**
     * @param SpecificationEvent $sus
     */
    public function analyse(SpecificationEvent $sus)
    {
        $class = $sus->getSpecification()->getTitle();
        $this->sus = new ReflectionClass($class);
        $this->checkClass();
    }

    /**
     * @throws \Elfiggo\Brobdingnagian\Exception\ClassSizeTooLarge
     */
    public function checkClass()
    {
        $classSize = new ClassSize($this->sus);
        $classSize->check();
    }
}
