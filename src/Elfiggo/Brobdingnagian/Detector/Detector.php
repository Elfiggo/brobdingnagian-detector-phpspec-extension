<?php

namespace Elfiggo\Brobdingnagian\Detector;


use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\Reporter;
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
     * @var Reporter
     */
    private $reporter;

    /**
     * @param SpecificationEvent $sus
     * @param Params $param
     * @param Reporter $reporter
     */
    public function analyse(SpecificationEvent $sus, Params $param, Reporter $reporter)
    {
        $class = $sus->getSpecification()->getTitle();
        $this->sus = new ReflectionClass($class);
        $this->param = $param;
        $this->reporter = $reporter;
        $this->checkClass();
    }

    public function checkClass()
    {
        $classSize = new ClassSize($this->sus, $this->param, $this->reporter);
        $classSize->check();
    }
}
