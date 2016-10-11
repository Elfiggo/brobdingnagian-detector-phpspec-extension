<?php

namespace Elfiggo\Brobdingnagian\Detector;

use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\Reporter;
use ReflectionClass;

/**
 * Class NumberOfMethods
 * @package Elfiggo\Brobdingnagian\Detector
 */
class NumberOfMethods implements DetectionInterface
{

    /**
     * @param ReflectionClass $sus
     * @param Params          $params
     * @param Reporter        $reporter
     */
    public function check(ReflectionClass $sus, Params $params, Reporter $reporter)
    {
        if (count($sus->getMethods($params->getFilterMethods())) > $params->getNumberOfMethods()) {
            $reporter->act(
                $sus,
                self::class,
                "{$sus->getName()} has too many methods (" . count($sus->getMethods()) .')',
                'Too many methods'
            );
        }
    }
}
