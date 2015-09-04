<?php

namespace Elfiggo\Brobdingnagian\Report;

use ReflectionClass;

class LoggerHandler implements Handler
{

    private $log = [];

    /**
     * @param ReflectionClass $sus
     * @param $class
     * @param $message
     */
    public function act(ReflectionClass $sus, $class, $message)
    {
        $this->log[$sus->getName()][] = ['message' => $message, 'class' => $class, 'errorType' => $this->errorType($class)];
    }

    private function errorType($class)
    {
        switch($class) {
            case 'Elfiggo\Brobdingnagian\Detector\ClassSize':
                return 'Class size';
                break;
            case 'Elfiggo\Brobdingnagian\Detector\DependenciesSize':
                return 'Dependencies size';
                break;
            case 'Elfiggo\Brobdingnagian\Detector\MethodSize':
                return 'Method size';
                break;
            case 'Elfiggo\Brobdingnagian\Detector\NumberOfMethods':
                return 'Too many methods';
                break;
            default:return 'Unknown';break;
        }
    }

    /**
     * @return array
     */
    public function messages()
    {
        return $this->log;
    }
}
