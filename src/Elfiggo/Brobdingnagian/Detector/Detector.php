<?php

namespace Elfiggo\Brobdingnagian\Detector;


use Elfiggo\Brobdingnagian\Param\Params;
use PhpSpec\Event\SpecificationEvent;
use ReflectionClass;

class Detector
{
    /**
     * @var ReflectionClass
     */
    private $sus;

    /**
     * @var Params
     */
    private $param;

    /**
     * @param SpecificationEvent $sus
     * @param Params $param
     */
    public function analyse(SpecificationEvent $sus, Params $param)
    {
        $class = $sus->getSpecification()->getTitle();
        $this->sus = new ReflectionClass($class);
        $this->param = $param;
        $this->checkClass();
    }

    /**
     * @throws \Elfiggo\Brobdingnagian\Exception\ClassSizeTooLarge
     */
    public function checkClass()
    {
        $classSize = new ClassSize($this->sus, $this->param);
        $classSize->check();
    }
}
