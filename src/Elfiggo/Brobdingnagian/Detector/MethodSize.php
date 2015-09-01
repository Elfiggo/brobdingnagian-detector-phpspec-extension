<?php

namespace Elfiggo\Brobdingnagian\Detector;

use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\Reporter;
use ReflectionClass;

class MethodSize implements Detection
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

    /**
     * @throws \Elfiggo\Brobdingnagian\Exception\MethodSizeTooLarge
     */
    public function check()
    {
        foreach($this->sus->getMethods() as $method)
        {
            $lineSize = $method->getEndLine() - $method->getStartLine();
            if ($lineSize > $this->params->getMethodSize()) {
                $this->reporter->act($this->sus, self::class, "{$method->getName()} size is $lineSize long");
            }
        }
    }
}
