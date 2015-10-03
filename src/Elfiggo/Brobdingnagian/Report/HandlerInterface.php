<?php

namespace Elfiggo\Brobdingnagian\Report;

use ReflectionClass;

/**
 * Interface Handler
 * @package Elfiggo\Brobdingnagian\Report
 */
interface HandlerInterface
{
    /**
     * @param  ReflectionClass $sus
     * @param  string          $class
     * @param  string          $message
     * @param  string          $errorType
     * @return void
     */
    public function act(ReflectionClass $sus, $class, $message, $errorType = 'Unknown');
} 
