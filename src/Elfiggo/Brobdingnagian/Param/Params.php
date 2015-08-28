<?php

namespace Elfiggo\Brobdingnagian\Param;

use PhpSpec\ServiceContainer;

class Params
{
    const CLASS_SIZE = 300;

    /**
     * @var ServiceContainer
     */
    private $params;

    /**
     * @var InputInterface
     */
    private $input;


    public function __construct(ServiceContainer $serviceContainer)
    {
        $this->input = $serviceContainer->get('console.input');
        $this->params = $serviceContainer->getParam('brobdingnagian');
    }

    public function getClassSize()
    {
         return (int) $this->params['class-size'] ?: self::CLASS_SIZE;
    }

    public function getBrobList()
    {
        return null !== $this->input->getOption('list-brob') ?
            $this->listBrobOption() :
            $this->listBrobConfig();
    }

    private function listBrobOption()
    {
        return strtolower($this->input->getOption('list-brob')) == 'true';
    }

    private function listBrobConfig()
    {
        return isset($this->params['list-brob']) ? $this->params['list-brob'] : false;
    }
}
