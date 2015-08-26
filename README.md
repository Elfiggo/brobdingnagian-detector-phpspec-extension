[![Build Status](https://travis-ci.org/Elfiggo/brobdingnagian-detector-phpspec-extension.svg?branch=master)](https://travis-ci.org/Elfiggo/brobdingnagian-detector-phpspec-extension)
# brobdingnagian-detector-phpspec-extension
Detects if your class and methods are too big and suggest to extract responsibilities and collaborators

## Enable the extension

Add the following to your `phpspec.yml` under `extensions`

    extensions:
        -Elfiggo\Brobdingnagian\Extension

See [PhpSpec Extension Documentation](http://www.phpspec.net/en/latest/cookbook/extensions.html) if you are having trouble

## Parameters

    brobdingnagian:
        class_size: 300
        method_size: 15
        dependencies: 3
        
## Usage

Use as normal with phpspec, if you want to disable exceptions for Brobdingnagian and list the
classes, methods or dependencies instead, then pass the following flag.

    phpspec r --listbrob
    

## Supported PHP Versions

Currently PHP 5.5 and above

Follows [php security support](http://php.net/supported-versions.php) release cycle for minimum supported versions

## To Do - Brobdingnagian

1. Configurable limits
    * Look for configurable limit in spec file or set default if not set.
    * Configure Brob Exceptions to not throw if using list
2. Number of Class dependencies
    * Count number of dependencies
    * add configurable limit
3. Count number of methods
    * Add configurable limits
4.  Size of methods
    * Check each method in class size
    * Add configurable limits
5. Add List output option of all in CSV format
6. Ship It! (East Croydon)
7. Add Dictionary of suggestible class names for roles
8. Ship it! (Blackpool)
9. Ask to split class/methods into a helper class
    * Create New Helper class with Spec stubs of current class
10. Ship it! (Derby)
