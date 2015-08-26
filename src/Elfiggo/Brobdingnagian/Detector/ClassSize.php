<?php

namespace Elfiggo\Brobdingnagian\Detector;

use Elfiggo\Brobdingnagian\Param\Params;
use ReflectionClass;

class ClassSize
{
    /**
     * @var ReflectionClass
     */
    private $sus;

    /**
     * @var params
     */
    private $params;

    public function __construct(ReflectionClass $sus, Params $params)
    {
        $this->sus = $sus;
        $this->params = $params;
    }

    /**
     * @throws \Elfiggo\Brobdingnagian\Exception\ClassSizeTooLarge
     */
    public function check()
    {
        if ($this->sus->getEndLine() > $this->params->getClassSize()) {
            throw new \Elfiggo\Brobdingnagian\Exception\ClassSizeTooLarge($this->sus->getName());
        }
    }
}
