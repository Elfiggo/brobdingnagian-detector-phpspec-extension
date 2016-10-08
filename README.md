[![Build Status](https://travis-ci.org/Elfiggo/brobdingnagian-detector-phpspec-extension.svg?branch=master)](https://travis-ci.org/Elfiggo/brobdingnagian-detector-phpspec-extension)
# brobdingnagian-detector-phpspec-extension
Detects if your class and methods are too big and suggest to extract responsibilities and collaborators

## Installation

         "require-dev": {
            "elfiggo/brobdingnagian-detector":"^0.1.0"
          }

## Enable the extension

Add the following to your `phpspec.yml` under `extensions`

    extensions:
        - Elfiggo\Brobdingnagian\Extension

See [PhpSpec Extension Documentation](http://www.phpspec.net/en/latest/cookbook/extensions.html) if you are having trouble

## Parameters

    brobdingnagian:
        class-size: 300
        method-size: 10
        number-of-methods: 5
        filter-methods:
           static: true
           public: true
           protected: true
           private: true
           abstract: true
           final: true
        dependencies: 4
        list-brob: true
        create-csv: false
        number-of-interfaces: 3
        number-of-traits: 1

        
## Usage

Use as normal with phpspec, if you want to disable exceptions for Brobdingnagian and list the
classes, methods or dependencies instead, then pass the following flag, this has precedence over the phpspec.yml parameter.

    phpspec r --list-brob=true (Turns Exceptions Off)
    phpspec r --list-brob=false (Turns Exceptions On)
    

## Filter Methods

Turn off checks for methods that are private or final by setting to `false`

You can remove the `filter-methods` arguments entirely/

Turning off `final` but not `public` on methods that are `final` and `public` will still appear as they conform to a `public` signiture.
 
See [ReflectionClass::getMethods](http://php.net/manual/en/reflectionclass.getmethods.php) for more information.


## Supported PHP Versions

Currently PHP 5.5 and above

Follows [php security support](http://php.net/supported-versions.php) release cycle for minimum supported versions

## To Do - Brobdingnagian

1. Ship It! (East Croydon)
2. Add Dictionary of suggestible class names for roles
3. Ship it! (Blackpool)
4. Ask to split class/methods into a helper class
    * Create New Helper class with Spec stubs of current class
5. Ship it! (Derby)
