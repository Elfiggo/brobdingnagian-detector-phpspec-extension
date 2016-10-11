<?php

namespace Elfiggo\Brobdingnagian\Detector;

use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\Reporter;
use ReflectionClass;

/**
 * Class NumberOfInterfaces
 * @package Elfiggo\Brobdingnagian\Detector
 */
class NumberOfInterfaces implements DetectionInterface
{

    /**
     * @param ReflectionClass $sus
     * @param Params          $param
     * @param Reporter        $reporter
     */
    public function check(ReflectionClass $sus, Params $param, Reporter $reporter)
    {
        if (count($sus->getInterfaces()) > $param->getNumberOfInterfaces()) {
            $reporter->act(
                $sus,
                self::class,
                "{$sus->getName()} has too many interfaces (" . count($sus->getInterfaces()) .')',
                'Too many interfaces'
            );
        }
    }
}
