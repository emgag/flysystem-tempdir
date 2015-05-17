<?php

namespace Emgag\Flysystem;

use League\Flysystem\Filesystem;

class Tempdir extends Filesystem
{

    /**
     * Creates a temporary directory
     *
     * @param string $prefix
     * @param null   $dir
     */
    public function __construct($prefix = '', $dir = null)
    {
        parent::__construct(new TempdirAdapter($prefix, $dir));
    }

    /**
     * Returns fully qualified filesystem path for temp directory
     *
     * @return string
     */
    public function getPath()
    {
        return $this->getAdapter()->getPathPrefix();
    }


}