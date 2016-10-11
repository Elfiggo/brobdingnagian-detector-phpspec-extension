<?php

namespace Elfiggo\Brobdingnagian\Report;

use ReflectionClass;

class LoggerHandler implements HandlerInterface
{

    private $log = [];

    /**
     * @param ReflectionClass $sus
     * @param $class
     * @param $message
     * @param $errorType
     * @return void
     */
    public function act(ReflectionClass $sus, $class, $message, $errorType = 'Unknown')
    {
        $this->log[$sus->getName()][] = ['message' => $message, 'class' => $class, 'errorType' => $errorType];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return $this->log;
    }
}
