<?php

namespace Elfiggo\Brobdingnagian\Detector;

use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\Reporter;
use ReflectionClass;

/**
 * Class NumberOfTraits
 * @package Elfiggo\Brobdingnagian\Detector
 */
class NumberOfTraits implements DetectionInterface
{

    /**
     * @param ReflectionClass $sus
     * @param Params          $param
     * @param Reporter        $reporter
     */
    public function check(ReflectionClass $sus, Params $param, Reporter $reporter)
    {
        if (count($sus->getTraits()) > $param->getNumberOfTraits()) {
            $reporter->act(
                $sus,
                self::class,
                "{$sus->getName()} has too many traits (" . count($sus->getTraits()) .')',
                'Too many traits'
            );
        }
    }
}
