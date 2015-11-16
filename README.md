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

1. <del>Configurable limits</del>
    * <del>Configure Brob Exceptions to not throw if using list</del>
2. <del>Number of Class dependencies</del>
    * <del>Count number class construct dependencies</del>
    * <del>add configurable limit</del>
    * <del>add error type</del>
3. <del>Count number of methods</del>
    * <del>Add configurable limits</del>
    * <del>add error type</del>
4.  <del>Size of methods</del>
    * <del>Check each method size</del>
    * <del>Check number of method dependencies</del>
    * <del>Add configurable limits</del>
    * <del>add error type</del>
5. <del>Add List output formatter</del>
    * <del>table view (default)</del>
    * <del>update log message/exception message where appropriate</del>
    * <del>add back error type</del>
    * <del>group class messages together to be more meaningful in large lists</del>
    * <del>exportable option of all in CSV format</del>
    * <del>add class size error type</del>
    * <del>refactoring period</del>
6. Add Backlog
    * <del>add configurable filter for number of methods (public|private|protected)</del>
    * <del>add traits detector</del>
    * <del>add interfaces detector</del>
7. Ship It! (East Croydon)
8. Add Dictionary of suggestible class names for roles
9. Ship it! (Blackpool)
10. Ask to split class/methods into a helper class
    * Create New Helper class with Spec stubs of current class
11. Ship it! (Derby)
