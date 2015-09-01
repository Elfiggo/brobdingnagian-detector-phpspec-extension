<?php

namespace Elfiggo\Brobdingnagian\Detector;

use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\Reporter;
use ReflectionClass;

class DependenciesSize implements Detection
{

    /**
     * @var ReflectionClass
     */
    private $sus;
    /**
     * @var Params
     */
    private $params;
    /**
     * @var Reporter
     */
    private $reporter;

    /**
     * @param ReflectionClass $sus
     * @param Params $params
     * @param Reporter $reporter
     */
    public function __construct(ReflectionClass $sus, Params $params, Reporter $reporter)
    {
        $this->sus = $sus;
        $this->params = $params;
        $this->reporter = $reporter;
    }

    /**
     * @throws \Elfiggo\Brobdingnagian\Exception\DepedenciesSizeTooLarge
     */
    public function check()
    {
        foreach ($this->sus->getMethods() as $method) {

            if ($method->getNumberOfParameters() > $this->params->getDependenciesLimit()) {
                $this->reporter->act($this->sus, self::class, "{$method->getName()} has too many dependencies ({$method->getNumberOfParameters()})");
            }

        }
    }
}
