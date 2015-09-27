<?php

namespace Elfiggo\Brobdingnagian\Detector;

use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\Reporter;
use ReflectionClass;

class NumberOfTraits implements Detection
{
    public function check(ReflectionClass $sus, Params $param, Reporter $reporter)
    {
        if (count($sus->getTraits()) > $param->getNumberOfTraits()) {
            $reporter->act($sus, self::class, "{$sus->getName()} has too many traits (" . count($sus->getTraits()) .')', 'Too many traits');
        }
    }
}
