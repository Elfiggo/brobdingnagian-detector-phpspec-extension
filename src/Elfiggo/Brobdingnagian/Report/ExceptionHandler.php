<?php

namespace Elfiggo\Brobdingnagian\Report;

use Elfiggo\Brobdingnagian\Exception\ClassSizeTooLarge;

class ExceptionHandler implements Handler
{
    public function act($message, $class)
    {
        switch($class) {
            case 'ClassSize': throw new ClassSizeTooLarge($message);break;
            default:break;
        }
    }
}
