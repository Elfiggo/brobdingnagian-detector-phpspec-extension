<?php

namespace Elfiggo\Brobdingnagian\Report;


interface Handler
{
    public function act($message, $class);
} 
