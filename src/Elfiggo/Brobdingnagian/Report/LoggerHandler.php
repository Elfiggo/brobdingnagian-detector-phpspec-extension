<?php

namespace Elfiggo\Brobdingnagian\Report;

use PhpSpec\Console\IO;
use ReflectionClass;

class LoggerHandler implements Handler
{

    private $log = [];

    private $io;

    public function __construct(IO $io)
    {
        $this->io = $io;
    }

    /**
     * @param ReflectionClass $sus
     * @param $class
     * @param $errorType
     */
    public function act(ReflectionClass $sus, $class, $errorType)
    {
        $message = $sus->getName() . ' (' . $sus->getEndLine() . ')';

        $this->log[] = ['message' => $message, 'class' => $class, 'errorType' => $errorType];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return $this->log;
    }

    public function output()
    {
        foreach($this->messages() as $data) {
            $this->io->writeln($data['message']);
        }
    }
}
