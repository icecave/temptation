# Temptation

[![Build Status]](https://travis-ci.org/IcecaveStudios/temptation)
[![Test Coverage]](https://coveralls.io/r/IcecaveStudios/temptation?branch=develop)
[![SemVer]](http://semver.org)

**Temptation** is a simple PHP library for creating temporary files and directories that clean up after themselves.

* Install via [Composer](http://getcomposer.org) package [icecave/temptation](https://packagist.org/packages/icecave/temptation)
* Read the [API documentation](http://icecavestudios.github.io/temptation/artifacts/documentation/api/)

## Example

```php
use Icecave\Temptation\Temptation;

// Use the temptation object to create files and directories ...
$temptation = new Temptation;

// Create a temporary file ...
$file = $temptation->createFile();

// Use the temporary file ...
file_put_contents($file->path(), 'This is my temp file.');

// Don't do anything else!
// The temporary file is automatically deleted when the $file object goes out of scope.
```

<!-- references -->
[Build Status]: http://b.adge.me/travis/IcecaveStudios/temptation/develop.svg
[Test Coverage]: http://b.adge.me/coveralls/IcecaveStudios/temptation/develop.svg
[SemVer]: http://b.adge.me/:semver-0.0.0-red.svg
