<?php

namespace Elfiggo\Brobdingnagian\Report;

use ReflectionClass;

interface Handler
{
    /**
     * @param ReflectionClass $sus
     * @param $class
     * @param $message
     * @return mixed
     */
    public function act(ReflectionClass $sus, $class, $message);
} 
