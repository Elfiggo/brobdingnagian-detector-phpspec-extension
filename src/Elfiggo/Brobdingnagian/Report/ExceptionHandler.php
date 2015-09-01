<?php

namespace Elfiggo\Brobdingnagian\Report;

use Elfiggo\Brobdingnagian\Exception\ClassSizeTooLarge;
use Elfiggo\Brobdingnagian\Exception\DependenciesSizeTooLarge;
use Elfiggo\Brobdingnagian\Exception\MethodSizeTooLarge;
use Elfiggo\Brobdingnagian\Exception\TooManyMethodsDetected;
use ReflectionClass;

class ExceptionHandler implements Handler
{
    /**
     * @param ReflectionClass $sus
     * @param $class
     * @param $errorType
     */
    public function act(ReflectionClass $sus, $class, $message)
    {
        switch($class) {
            case 'Elfiggo\Brobdingnagian\Detector\ClassSize':
                throw new ClassSizeTooLarge($message);
                break;
            case 'Elfiggo\Brobdingnagian\Detector\DependenciesSize':
                throw new DependenciesSizeTooLarge($message);
                break;
            case 'Elfiggo\Brobdingnagian\Detector\MethodSize':
                throw new MethodSizeTooLarge($message);
                break;
            case 'Elfiggo\Brobdingnagian\Detector\NumberOfMethods':
                throw new TooManyMethodsDetected($message);
                break;
            default:break;
        }
    }
}
