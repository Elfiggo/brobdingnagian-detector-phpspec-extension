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
        class-size: 300
        method-size: 15
        number-of-methods: 5
        dependencies: 3
        list-brob: true|false
        
## Usage

Use as normal with phpspec, if you want to disable exceptions for Brobdingnagian and list the
classes, methods or dependencies instead, then pass the following flag, this has precedence over the phpspec.yml parameter.

    phpspec r --list-brob=true (Turns Exceptions Off)
    phpspec r --list-brob=false (Turns Exceptions On)
    

## Supported PHP Versions

Currently PHP 5.5 and above

Follows [php security support](http://php.net/supported-versions.php) release cycle for minimum supported versions

## To Do - Brobdingnagian

1. <del>Configurable limits</del>
    * <del>Configure Brob Exceptions to not throw if using list</del>
2. <del>Number of Class dependencies</del>
    * <del>Count number class construct dependencies</del>
    * <del>add configurable limit</del>
    * <del>add error type</del>
3. Count number of methods
    * <del>Add configurable limits</del>
    * <del>add error type</del>
4.  Size of methods
    * Check each method size
    * Check number of method dependencies
    * <del>Add configurable limits</del>
    * <del>add error type</del>
5. Add List output formatter
    * table view (default)
    * exportable option of all in CSV format
    * <del>add class size error type</del>
6. Ship It! (East Croydon)
7. Add Dictionary of suggestible class names for roles
8. Ship it! (Blackpool)
9. Ask to split class/methods into a helper class
    * Create New Helper class with Spec stubs of current class
10. Ship it! (Derby)
