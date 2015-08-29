<?php

namespace Elfiggo\Brobdingnagian\Report;

use ReflectionClass;

class LoggerHandler implements Handler
{
    private $log = [];

    /**
     * @param ReflectionClass $sus
     * @param $class
     * @param $errorType
     */
    public function act(ReflectionClass $sus, $class, $errorType)
    {
        $message = $sus->getName() . ' (' . $sus->getEndLine() . ')';

        $this->log[] = ['message' => $message, 'class' => $class, 'errorType' => $errorType];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return $this->log;
    }
}
