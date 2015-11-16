<?php

namespace Elfiggo\Brobdingnagian\Detector;

use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\Reporter;
use ReflectionClass;

/**
 * Class MethodSize
 * @package Elfiggo\Brobdingnagian\Detector
 */
class MethodSize implements Detection
{

    /**
     * @param ReflectionClass $sus
     * @param Params          $params
     * @param Reporter        $reporter
     */
    public function check(ReflectionClass $sus, Params $params, Reporter $reporter)
    {
        foreach($sus->getMethods($params->getFilterMethods()) as $method) {
            $lineSize = $method->getEndLine() - $method->getStartLine();
            if ($lineSize > $params->getMethodSize()) {
                $reporter->act(
                    $sus,
                    self::class,
                    "{$method->getName()}() size is $lineSize lines long",
                    'Method size'
                );
            }
        }
    }
}
