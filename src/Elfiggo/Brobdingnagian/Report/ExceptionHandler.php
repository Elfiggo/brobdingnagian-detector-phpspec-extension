<?php

namespace Elfiggo\Brobdingnagian\Report;

use Elfiggo\Brobdingnagian\Exception\ClassSizeTooLarge;
use Elfiggo\Brobdingnagian\Exception\DependenciesSizeTooLarge;
use Elfiggo\Brobdingnagian\Exception\MethodSizeTooLarge;
use Elfiggo\Brobdingnagian\Exception\TooManyInterfacesDetected;
use Elfiggo\Brobdingnagian\Exception\TooManyMethodsDetected;
use Elfiggo\Brobdingnagian\Exception\TooManyTraitsDetected;
use ReflectionClass;

/**
 * Class ExceptionHandler
 * @package Elfiggo\Brobdingnagian\Report
 */
class ExceptionHandler implements Handler
{
    /**
     * @param ReflectionClass $sus
     * @param string          $class
     * @param string          $message
     * @param string          $errorType
     *
     * @throws ClassSizeTooLarge
     * @throws DependenciesSizeTooLarge
     * @throws MethodSizeTooLarge
     * @throws TooManyInterfacesDetected
     * @throws TooManyMethodsDetected
     * @throws TooManyTraitsDetected
     */
    public function act(ReflectionClass $sus, $class, $message, $errorType = 'Unknown')
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
            case 'Elfiggo\Brobdingnagian\Detector\NumberOfInterfaces':
                throw new TooManyInterfacesDetected($message);
                break;
            case 'Elfiggo\Brobdingnagian\Detector\NumberOfTraits':
                throw new TooManyTraitsDetected($message);
                break;
            default:break;
        }
    }
}
