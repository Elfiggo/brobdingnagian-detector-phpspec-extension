<?php

namespace Elfiggo\Brobdingnagian\Detector;


use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\Reporter;
use PhpSpec\Event\SpecificationEvent;
use PhpSpec\Exception\Fracture\InterfaceNotImplementedException;
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
     * @param array $detections
     */
    private $detections = [];


    public function __construct(array $detections = [])
    {
        $validations = array_merge($this->coreDetections(), $detections);

        foreach ($validations as $subject) {
            if ($subject instanceof Detection) {
                $this->detections[] = $subject;
            } else {
                throw new InterfaceNotImplementedException("Does not implement the Detection interface", $subject, 'Detection');
            }
        }
    }

    private function coreDetections()
    {
        return [new ClassSize(), new DependenciesSize(), new NumberOfMethods(), new MethodSize()];
    }

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

        foreach ($this->detections as $detection) {
            $detection->check($this->sus, $this->param, $this->reporter);
        }
    }

}
