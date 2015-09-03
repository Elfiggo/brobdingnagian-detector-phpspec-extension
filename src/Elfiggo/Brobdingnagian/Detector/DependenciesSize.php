<?php

namespace Elfiggo\Brobdingnagian\Detector;

use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\Reporter;
use ReflectionClass;

class DependenciesSize implements Detection
{

    /**
     * @param ReflectionClass $sus
     * @param Params $params
     * @param Reporter $reporter
     */
    public function check(ReflectionClass $sus, Params $params, Reporter $reporter)
    {
        foreach ($sus->getMethods() as $method) {

            if ($method->getNumberOfParameters() > $params->getDependenciesLimit()) {
                $reporter->act($sus, self::class, "{$method->getName()} has too many dependencies ({$method->getNumberOfParameters()})");
            }

        }
    }
}
