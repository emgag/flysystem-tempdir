# Flysystem Adapter for Temporary Directory

[![Build Status](https://img.shields.io/travis/emgag/flysystem-tempdir/master.svg?style=flat-square)](https://travis-ci.org/emgag/flysystem-tempdir)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Packagist Version](https://img.shields.io/packagist/v/emgag/flysystem-tempdir.svg?style=flat-square)](https://packagist.org/packages/emgag/flysystem-tempdir)
[![Project Status: Active - The project has reached a stable, usable state and is being actively developed.](http://www.repostatus.org/badges/0.1.0/active.svg)](http://www.repostatus.org/#active)

An adapter for the [Flysystem](https://github.com/thephpleague/flysystem) file 
system abstraction library which creates a temporary director on local filesystem
and which is automatically removed again on object destruct.

## Installation

```bash
composer require emgag/flysystem-tempdir
```

## Usage


As League\Flysystem\Filesystem wrapper:

```php
use Emgag\Flysystem\Tempdir;
$fs = new Tempdir([$prefix],[$tempdir]);
// fully qualified FS path
$fsPath = $fs->getPath();
```


or as Flysystem Adapter:

```php
use Emgag\Flysystem\TempdirAdapter;
use League\Flysystem\Filesystem;

$adapter = new TempdirAdapter([$prefix],[$tempdir]);

$filesystem = new Filesystem($adapter);
```

## License

flysystem-tempdir is licensed under the [MIT License](http://opensource.org/licenses/MIT).

