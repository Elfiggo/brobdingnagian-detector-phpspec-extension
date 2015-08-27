<?php

namespace spec\Elfiggo\Brobdingnagian\Report;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LoggerHandlerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Report\LoggerHandler');
    }

    function it_should_implement_the_handler_interface()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Report\Handler');
    }

    function it_should_return_an_array_of_messages()
    {
        $this->act('Error 1', 'ClassSize');
        $this->act('Error 2', 'ClassSize');
        $this->act('Error 3', 'ClassSize');
        $this->act('Error 4', 'ClassSize');

        $recordedMessages = [
            ['message' => 'Error 1', 'class' => 'ClassSize'],
            ['message' => 'Error 2', 'class' => 'ClassSize'],
            ['message' => 'Error 3', 'class' => 'ClassSize'],
            ['message' => 'Error 4', 'class' => 'ClassSize'],
        ];

        $this->messages()->shouldReturn($recordedMessages);
    }
}
