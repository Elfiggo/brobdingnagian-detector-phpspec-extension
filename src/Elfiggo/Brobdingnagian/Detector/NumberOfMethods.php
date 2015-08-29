<?php

namespace Elfiggo\Brobdingnagian\Detector;

use ReflectionClass;

class NumberOfMethods implements Detection
{

    /**
     * @var ReflectionClass
     */
    private $sus;

    public function __construct(ReflectionClass $sus)
    {
        $this->sus = $sus;
    }

    public function check()
    {
        // TODO: Implement check() method.
    }
}
