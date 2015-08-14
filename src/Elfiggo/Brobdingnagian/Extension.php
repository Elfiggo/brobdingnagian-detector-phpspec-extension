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
        $container->setShared('elfiggo.brobdingnagian.listener.class_listener', function ($c) {
            return new ClassListener();
        });
    }
}
