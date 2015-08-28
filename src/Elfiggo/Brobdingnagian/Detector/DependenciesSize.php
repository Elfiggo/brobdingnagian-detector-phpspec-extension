<?php

namespace Elfiggo\Brobdingnagian\Detector;

use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\Reporter;
use ReflectionClass;

class DependenciesSize
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
        if ($this->sus->hasMethod('__construct')) {
            $reflectionMethod = $this->sus->getMethod('__construct');

            if ($reflectionMethod->getNumberOfParameters() > $this->params->getDependenciesLimit()) {
                $this->reporter->act($this->sus, self::class);
            }
        }
    }
}
