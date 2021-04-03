<?php

namespace Emgag\Flysystem;

use League\Flysystem\Filesystem;

class Tempdir extends Filesystem
{
    /**
     * @var TempdirAdapter
     */
    private $adapter;

    /**
     * Creates a temporary directory.
     *
     * @param string $prefix
     * @param null   $dir
     * @param bool   $destruct
     */
    public function __construct($prefix = '', $dir = null, $destruct = true)
    {
        $this->adapter = new TempdirAdapter($prefix, $dir, $destruct);
        parent::__construct($this->adapter);
    }

    /**
     * Returns fully qualified filesystem path for temp directory.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->adapter->getPath();
    }
}
