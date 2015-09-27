<?php

namespace spec\Elfiggo\Brobdingnagian\Param;

use PhpSpec\ObjectBehavior;
use PhpSpec\ServiceContainer;
use Prophecy\Argument;
use Symfony\Component\Console\Input\InputInterface;


class ParamsSpec extends ObjectBehavior
{
    function let(ServiceContainer $serviceContainer, InputInterface $input)
    {
        $input->getOption('list-brob')->willReturn(true);
        $serviceContainer->get('console.input')->willReturn($input);
        $this->beConstructedWith($serviceContainer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Param\Params');
    }

    function it_returns_the_default_class_size(ServiceContainer $serviceContainer)
    {
        $serviceContainer->getParam('brobdingnagian')->willReturn(null);
        $this->getClassSize()->shouldReturn(300);
    }

    function it_should_return_a_custom_size(ServiceContainer $serviceContainer)
    {
        $serviceContainer->getParam('brobdingnagian')->willReturn(array('class-size' => 200));
        $this->getClassSize()->shouldReturn(200);
    }

    function it_should_return_brob_list_from_phpspec_yml(ServiceContainer $serviceContainer, InputInterface $input)
    {
        $input->getOption('list-brob')->willReturn(null);
        $serviceContainer->getParam('brobdingnagian')->willReturn(array('list-brob' => true));
        $this->getBrobList()->shouldReturn(true);
    }

    function it_should_not_return_brob_list_from_option(ServiceContainer $serviceContainer, InputInterface $input)
    {
        $input->getOption('list-brob')->willReturn("false");
        $serviceContainer->getParam('brobdingnagian')->willReturn(null);
        $this->getBrobList()->shouldReturn(false);
    }

    function it_should_not_return_brob_list_from_phpspec_yml(ServiceContainer $serviceContainer, InputInterface $input)
    {
        $input->getOption('list-brob')->willReturn("true");
        $serviceContainer->getParam('brobdingnagian')->willReturn(null);
        $this->getBrobList()->shouldReturn(true);
    }

    function it_should_return_brob_list_from_option(ServiceContainer $serviceContainer, InputInterface $input)
    {
        $input->getOption('list-brob')->willReturn("true");
        $serviceContainer->getParam('brobdingnagian')->willReturn(null);
        $this->getBrobList()->shouldReturn(true);
    }

    function it_should_return_the_default_number_of_dependencies(ServiceContainer $serviceContainer)
    {
        $serviceContainer->getParam('brobdingnagian')->willReturn(null);
        $this->getDependenciesLimit()->shouldReturn(3);
    }

    function it_should_return_the_configured_number_of_dependencies(ServiceContainer $serviceContainer)
    {
        $serviceContainer->getParam('brobdingnagian')->willReturn(array('dependencies' => 2));
        $this->getDependenciesLimit()->shouldReturn(2);
    }

    function it_should_return_the_default_number_of_methods(ServiceContainer $serviceContainer)
    {
        $serviceContainer->getParam('brobdingnagian')->willReturn(null);
        $this->getNumberOfMethods()->shouldReturn(5);
    }

    function it_should_return_the_configured_number_of_methods(ServiceContainer $serviceContainer)
    {
        $serviceContainer->getParam('brobdingnagian')->willReturn(array('number-of-methods' => 2));
        $this->getNumberOfMethods()->shouldReturn(2);
    }

    function it_should_return_the_default_method_size(ServiceContainer $serviceContainer)
    {
        $serviceContainer->getParam('brobdingnagian')->willReturn(null);
        $this->getMethodSize()->shouldReturn(15);
    }

    function it_should_return_the_configured_method_size(ServiceContainer $serviceContainer)
    {
        $serviceContainer->getParam('brobdingnagian')->willReturn(array('method-size' => 2));
        $this->getMethodSize()->shouldReturn(2);
    }

    function it_should_return_the_csv_option(ServiceContainer $serviceContainer)
    {
        $serviceContainer->getParam('brobdingnagian')->willReturn(array('create-csv' => true));
        $this->getCsv()->shouldReturn(true);
    }

    function it_should_return_the_default_csv_option(ServiceContainer $serviceContainer)
    {
        $serviceContainer->getParam('brobdingnagian')->willReturn(null);
        $this->getCsv()->shouldReturn(false);
    }

    function it_should_return_the_default_number_of_interfaces(ServiceContainer $serviceContainer)
    {
        $serviceContainer->getParam('brobdingnagian')->willReturn(null);
        $this->getNumberOfInterfaces()->shouldReturn(3);
    }

}
