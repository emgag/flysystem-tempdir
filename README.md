# Flysystem Adapter for Temporary Directory



## Installation

```bash
TBD composer require emgag\flysystem-tempdir
```

## Usage


As League\Flysystem\Filesystem wrapper:

```php
use Emgag\Flysystem\Tempdir;
$fs = new Tempdir([$prefix],[$tempdir]);
```


or as Flysystem Adapter:

```php
use Emgag\Flysystem\TempdirAdapter;
use League\Flysystem\Filesystem;

$adapter = new TempdirAdapter([$prefix],[$tempdir]);

$filesystem = new Filesystem($adapter);
```
