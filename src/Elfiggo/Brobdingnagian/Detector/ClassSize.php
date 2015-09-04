<?php

namespace Elfiggo\Brobdingnagian\Detector;

use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\Reporter;
use ReflectionClass;



class ClassSize implements Detection
{
    /**
     * @param ReflectionClass $sus
     * @param Params $params
     * @param Reporter $reporter
     */
    public function check(ReflectionClass $sus, Params $params, Reporter $reporter)
    {
        if ($sus->getEndLine() > $params->getClassSize()) {
            $reporter->act($sus, self::class, "{$sus->getName()} class size is too large ({$sus->getEndLine()})", 'Class size');
        }
    }
}
