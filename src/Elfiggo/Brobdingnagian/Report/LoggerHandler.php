<?php

namespace Elfiggo\Brobdingnagian\Report;

class LoggerHandler implements Handler
{
    private $log = [];

    public function act($message, $class)
    {
        $this->log[] = ['message' => $message, 'class' => $class];
    }

    public function messages()
    {
        return $this->log;
    }
}
