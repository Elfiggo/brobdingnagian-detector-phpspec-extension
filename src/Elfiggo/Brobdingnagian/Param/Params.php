<?php

namespace Elfiggo\Brobdingnagian\Param;

use PhpSpec\ServiceContainer;

class Params
{
    const CLASS_SIZE = 300;
    const DEPENDENCIES_SIZE = 3;
    const NUMBER_OF_METHODS = 5;
    const METHOD_SIZE = 15;
    const LIST_BROB = false;
    const CREATE_CSV = false;

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
        return isset($this->params['list-brob']) ? $this->params['list-brob'] : self::LIST_BROB;
    }

    public function getDependenciesLimit()
    {
        return (int) $this->params['dependencies'] ?: self::DEPENDENCIES_SIZE;
    }

    public function getNumberOfMethods()
    {
        return (int) $this->params['number-of-methods'] ?: self::NUMBER_OF_METHODS;
    }

    public function getMethodSize()
    {
        return (int) $this->params['method-size'] ?: self::METHOD_SIZE;
    }

    public function getCsv()
    {
        return isset($this->params['create-csv']) ?: self::CREATE_CSV;
    }
}
