<?php

namespace Elfiggo\Brobdingnagian\Detector;

use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\Reporter;
use ReflectionClass;

/**
 * Class DependenciesSize
 * @package Elfiggo\Brobdingnagian\Detector
 */
class DependenciesSize implements DetectionInterface
{

    /**
     * @param ReflectionClass $sus
     * @param Params          $params
     * @param Reporter        $reporter
     */
    public function check(ReflectionClass $sus, Params $params, Reporter $reporter)
    {
        foreach ($sus->getMethods() as $method) {
            if ($method->getNumberOfParameters() > $params->getDependenciesLimit()) {
                $reporter->act(
                    $sus,
                    self::class,
                    "{$method->getName()} has too many dependencies ({$method->getNumberOfParameters()})",
                    'Dependencies size'
                );
            }
        }
    }
}
