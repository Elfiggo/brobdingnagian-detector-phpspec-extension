<?php

namespace Elfiggo\Brobdingnagian\Report;

use Elfiggo\Brobdingnagian\Exception\ClassSizeTooLarge;
use Elfiggo\Brobdingnagian\Exception\DependenciesSizeTooLarge;

class ExceptionHandler implements Handler
{
    public function act($message, $class)
    {
        switch($class) {
            case 'Elfiggo\Brobdingnagian\Detector\ClassSize':
                throw new ClassSizeTooLarge($message);
                break;
            case 'Elfiggo\Brobdingnagian\Detector\DependenciesSize':
                throw new DependenciesSizeTooLarge($message);
                break;
            default:break;
        }
    }
}
