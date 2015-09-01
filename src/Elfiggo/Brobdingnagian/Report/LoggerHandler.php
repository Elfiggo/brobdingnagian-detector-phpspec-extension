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
     * @param $message
     */
    public function act(ReflectionClass $sus, $class, $message)
    {
        $this->log[$sus->getName()][] = ['message' => $message, 'class' => $class, 'errorType' => $this->errorType($class)];
    }

    private function errorType($class)
    {
        switch($class) {
            case 'Elfiggo\Brobdingnagian\Detector\ClassSize':
                return 'Class size';
                break;
            case 'Elfiggo\Brobdingnagian\Detector\DependenciesSize':
                return 'Dependencies size';
                break;
            case 'Elfiggo\Brobdingnagian\Detector\MethodSize':
                return 'Method size';
                break;
            case 'Elfiggo\Brobdingnagian\Detector\NumberOfMethods':
                return 'Too many methods';
                break;
            default:return 'Unknown';break;
        }
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
        $this->io->writeln('');
        $this->io->writeln('-----------------------------------------------------------------------------');
        $this->io->writeln('------------------------- Brobdingnagian Table ------------------------------');
        $this->io->writeln('-----------------------------------------------------------------------------');
        foreach($this->messages() as $class => $data) {
            $this->io->writeln($data['errorType'] . '   |   ' . $data['message']);
        }
        $this->io->writeln('-----------------------------------------------------------------------------');
        $this->io->writeln('-----------------------------------------------------------------------------');
    }
}
