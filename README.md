# Temptation

[![Build Status](http://img.shields.io/travis/icecave/temptation/master.svg?style=flat-square)](https://travis-ci.org/icecave/temptation)
[![Code Coverage](https://img.shields.io/codecov/c/github/icecave/temptation/master.svg?style=flat-square)](https://codecov.io/github/icecave/temptation)
[![Latest Version](http://img.shields.io/packagist/v/icecave/temptation.svg?style=flat-square&label=semver)](https://semver.org)

**Temptation** is a simple PHP library for creating temporary files and
directories that clean up after themselves.

    composer require icecave/temptation

## Example

```php
use Icecave\Temptation\Temptation;

// Use the temptation object to create files and directories ...
$temptation = new Temptation();

// Create a temporary file ...
$file = $temptation->createFile();

// Use the temporary file ...
file_put_contents($file->path(), 'This is my temp file.');

// Don't do anything else!
// The temporary file is automatically deleted when the $file object goes out of scope.
```
