<?php

namespace Elfiggo\Brobdingnagian\Param;

use PhpSpec\ServiceContainer;

class Params
{
    const CLASS_SIZE = 300;

    /**
     * @var array
     */
    private $params;

    public function __construct(ServiceContainer $c)
    {
        $this->params = $c->getParam('brobdingnagian');
    }

    public function getClassSize()
    {
         return $this->params['class_size'] ?: self::CLASS_SIZE;
    }
}
