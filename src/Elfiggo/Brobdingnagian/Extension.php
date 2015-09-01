<?php

namespace Elfiggo\Brobdingnagian;

use Elfiggo\Brobdingnagian\Console;
use Elfiggo\Brobdingnagian\Console\Command\ListBrobCommand;
use Elfiggo\Brobdingnagian\Detector\Detector;
use Elfiggo\Brobdingnagian\Listener\ClassListener;
use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\LoggerHandler;
use Elfiggo\Brobdingnagian\Report\Reporter;
use PhpSpec\Extension\ExtensionInterface;
use PhpSpec\ServiceContainer;


class Extension implements ExtensionInterface
{
    /**
     * @param ServiceContainer $container
     */
    public function load(ServiceContainer $container)
    {
        $container->setShared('event_dispatcher.listeners.class_listener', function (ServiceContainer $c) {
            return new ClassListener(
                $c->get('elfiggo.brobdingnagian.detector'),
                $c->get('elfiggo.brobdingnagian.params'),
                $c->get('elfiggo.brobdingnagian.reporter'),
                $c->get('elfiggo.brobdingnagian.logger')
            );
        });


        $container->setShared('elfiggo.brobdingnagian.detector', function () {
            return new Detector();
        });

        $container->setShared('elfiggo.brobdingnagian.params', function (ServiceContainer $c) {
            return new Params($c);
        });

        $container->setShared('elfiggo.brobdingnagian.reporter', function (ServiceContainer $c) {
            return new Reporter(
                $c->get('elfiggo.brobdingnagian.params'),
                $c->get('elfiggo.brobdingnagian.logger')
            );
        });

        $container->setShared('elfiggo.brobdingnagian.logger', function (ServiceContainer $c) {
            return new LoggerHandler($c->get('console.io'));
        });

        $container->setShared('console.commands.run', function () {
            return new ListBrobCommand();
        });

    }
}
