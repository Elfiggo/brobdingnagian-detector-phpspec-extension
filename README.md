[![Build Status](https://travis-ci.org/Elfiggo/brobdingnagian-detector-phpspec-extension.svg?branch=master)](https://travis-ci.org/Elfiggo/brobdingnagian-detector-phpspec-extension)
# brobdingnagian-detector-phpspec-extension
Detects if your class and methods are too big and suggest to extract responsibilities and collaborators

## Enable the extension

Add the following to your `phpspec.yml` under `extensions`

> Elfiggo\Brobdingnagian\Extension

See [PhpSpec Extension Documentation](http://www.phpspec.net/en/latest/cookbook/extensions.html) if you are having trouble

## To Do - Brobdingnagian

1. Configurable limits
    * Look for configurable limit in spec file or set default if not set.
    * Configure Brob Exceptions to not throw if using list
2. Number of Class Dependancies
    * Count number of dependancies
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
