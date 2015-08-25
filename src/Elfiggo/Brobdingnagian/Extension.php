<?php

namespace Elfiggo\Brobdingnagian;

use Elfiggo\Brobdingnagian\Console;
use Elfiggo\Brobdingnagian\Console\Command\ListBrobCommand;
use Elfiggo\Brobdingnagian\Detector\Detector;
use Elfiggo\Brobdingnagian\Listener\ClassListener;
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
            return new ClassListener($c->get('elfiggo.brobdingnagian.detector'));
        });
        $container->setShared('elfiggo.brobdingnagian.detector', function (ServiceContainer $c) {
            return new Detector();
        });
        $container->setShared('console.commands.run', function (ServiceContainer $c) {
            return new ListBrobCommand();
        });
    }
}
