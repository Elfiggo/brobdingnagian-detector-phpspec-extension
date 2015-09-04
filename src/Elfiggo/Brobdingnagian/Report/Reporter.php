<?php

namespace Elfiggo\Brobdingnagian\Report;

use Elfiggo\Brobdingnagian\Param\Params;
use PhpSpec\Console\IO;
use ReflectionClass;

class Reporter
{

    private $handler;

    public function __construct(Params $params, LoggerHandler $loggerHandler, ExceptionHandler $exceptionHandler)
    {
        $this->handler = $params->getBrobList() ?
            $loggerHandler :
            $exceptionHandler;
    }

    public function handlerType()
    {
        return get_class($this->handler);
    }

    public function act(ReflectionClass $sus, $class, $message, $errorType)
    {
        $this->handler->act($sus, $class, $message, $errorType);
    }

    public function output(IO $io)
    {
        if (count($this->handler->messages())) {
            $io->writeln('');
            $io->writeln('--------------------------------------------------------------------------------');
            $io->writeln('------------------------- Brobdingnagian Table ---------------------------------');
            $io->writeln('--------------------------------------------------------------------------------');
            $io->writeln('|  ' . str_pad('Error Type',17) . '  |  ' . str_pad('Message', 52) . '  |');
            foreach($this->handler->messages() as $class => $messages) {
                $io->writeln('--------------------------------------------------------------------------------');
                $io->writeln(str_pad('|  -- Class -- ', 22) . '|  ' . str_pad($class, 67 - strlen($class)));
                foreach ($messages as $data) {
                    $io->writeln('|  ' . str_pad($data['errorType'],17) . '  |  ' . $data['message']);
                }
            }
            $io->writeln('--------------------------------------------------------------------------------');
            $io->writeln('--------------------------------- End ------------------------------------------');
            $io->writeln('--------------------------------------------------------------------------------');
        }

    }

    public function csvOutput()
    {
        $fp = fopen('brobdingnagian-test-results.csv', 'w+');
        fputcsv($fp, ['Error Type', 'Message']);
        foreach($this->handler->messages() as $class => $messages) {
            fputcsv($fp, ['Class', $class]);
            foreach ($messages as $data) {
                fputcsv($fp, [$data['errorType'], $data['message']]);
            }
        }
        fclose($fp);
    }
}
