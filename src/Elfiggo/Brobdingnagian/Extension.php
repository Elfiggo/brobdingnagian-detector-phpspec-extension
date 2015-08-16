<?php

namespace Elfiggo\Brobdingnagian;

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
            return new ClassListener();
        });
    }
}
