<?php

namespace Emgag\Flysystem;

use League\Flysystem\Filesystem;

class Tempdir extends Filesystem
{
    private TempdirAdapter $adapter;

    /**
     * Creates a temporary directory.
     */
    public function __construct(string $prefix = '', ?string $dir = null, bool $destruct = true)
    {
        $this->adapter = new TempdirAdapter($prefix, $dir, $destruct);
        parent::__construct($this->adapter);
    }

    /**
     * Returns fully qualified filesystem path for temp directory.
     */
    public function getPath(): string
    {
        return $this->adapter->getPath();
    }
}
