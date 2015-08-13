<?php

namespace Elfiggo\Brobdingnagian\Detector;

use ReflectionMethod;

class MethodSize
{

    /**
     * @var ReflectionClass
     */
    private $sus;

    public function __construct(ReflectionMethod $sus)
    {
        $this->sus = $sus;
    }

    public function check()
    {
        $lineSize = $this->sus->getEndLine() - $this->sus->getStartLine();

        if ($lineSize > 20) {
            throw new \Elfiggo\Brobdingnagian\Exception\MethodSizeTooLarge;
        }
    }
}
