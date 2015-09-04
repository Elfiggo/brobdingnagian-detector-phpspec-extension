<?php

namespace Elfiggo\Brobdingnagian\Report;

use ReflectionClass;

interface Handler
{
    /**
     * @param ReflectionClass $sus
     * @param $class
     * @param $message
     * @param string $errorType
     * @return mixed
     */
    public function act(ReflectionClass $sus, $class, $message, $errorType = 'Unknown');
} 
