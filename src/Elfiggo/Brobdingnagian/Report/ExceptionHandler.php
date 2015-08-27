<?php

namespace Elfiggo\Brobdingnagian\Report;

use Elfiggo\Brobdingnagian\Exception\ClassSizeTooLarge;

class ExceptionHandler implements Handler
{
    public function act($string, $class)
    {
        switch($class) {
            case 'ClassSize': throw new ClassSizeTooLarge($string);break;
            default:break;
        }
    }
}
