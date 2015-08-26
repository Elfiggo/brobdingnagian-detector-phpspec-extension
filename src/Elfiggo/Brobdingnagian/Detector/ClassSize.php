<?php
namespace Elfiggo\Brobdingnagian\Detector;

use ReflectionClass;

class ClassSize
{

    /**
     * @var ReflectionClass
     */
    private $sus;

    public function __construct(ReflectionClass $sus)
    {
        $this->sus = $sus;
    }

    /**
     * @throws \Elfiggo\Brobdingnagian\Exception\ClassSizeTooLarge
     */
    public function check()
    {
        if ($this->sus->getEndLine() > 300) {
            throw new \Elfiggo\Brobdingnagian\Exception\ClassSizeTooLarge($this->sus->getName());
        }
    }
}
