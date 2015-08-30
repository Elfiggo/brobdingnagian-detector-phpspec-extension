<?php

namespace Elfiggo\Brobdingnagian\Detector;

use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\Reporter;
use ReflectionClass;

class NumberOfMethods implements Detection
{

    /**
     * @var ReflectionClass
     */
    private $sus;
    /**
     * @var Params
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

    public function check()
    {
        if (count($this->sus->getMethods()) > $this->params->getNumberOfMethods()) {
            $this->reporter->act($this->sus, self::class, 'Number of methods');
        }
    }
}
