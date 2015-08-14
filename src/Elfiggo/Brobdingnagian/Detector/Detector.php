<?php

namespace Elfiggo\Brobdingnagian\Detector;


use PhpSpec\Event\SpecificationEvent;

class Detector
{
    /**
     * @var SpecificationEvent
     */
    private $sus;

    /**
     * @param SpecificationEvent $sus
     */
    public function analyse(SpecificationEvent $sus)
    {
        $this->sus = $sus->getSpecification()->getClassReflection();
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
