<?php

namespace Elfiggo\Brobdingnagian\Detector;

use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\Reporter;
use ReflectionClass;

/**
 * Interface Detection
 * @package Elfiggo\Brobdingnagian\Detector
 */
interface Detection
{
    public function check(ReflectionClass $sus, Params $param, Reporter $reporter);
} 
