<?php

namespace Elfiggo\Brobdingnagian\Detector;

use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\Reporter;
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
    /**
     * @var Reporter
     */
    private $reporter;

    public function __construct(ReflectionClass $sus, Params $params, Reporter $reporter)
    {
        $this->sus = $sus;
        $this->params = $params;
        $this->reporter = $reporter;
    }

    /**
     * @throws \Elfiggo\Brobdingnagian\Exception\ClassSizeTooLarge
     */
    public function check()
    {
        if ($this->sus->getEndLine() > $this->params->getClassSize()) {
            $this->reporter->act($this->sus, self::class);
        }
    }
}
