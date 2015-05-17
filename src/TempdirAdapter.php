<?php

namespace Emgag\Flysystem;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

class TempdirAdapter extends Local
{

    /**
     * Creates a temporary directory
     *
     * @param string $prefix
     * @param null   $dir
     */
    public function __construct($prefix = '', $dir = null)
    {
        $maxTries = 1024;

        if (empty($dir)) {
            $dir = sys_get_temp_dir();
        } else {
            $dir = rtrim($dir, $this->pathSeparator);
        }

        do {
            $path = $dir . $this->pathSeparator . uniqid($prefix, true);

            if (!file_exists($path) && mkdir($path, 0700)) {
                break;
            }

            $maxTries--;
        } while ($maxTries > 0);

        if ($maxTries == 0) {
            throw new \RuntimeException("Couldn't create temporary directory, giving up");
        }

        parent::__construct($path);
    }


    /**
     * Removes temporary directory
     *
     * @throws \League\Flysystem\FileExistsException
     */
    public function __destruct()
    {
        $fs = new Filesystem(new Local(dirname($this->getPathPrefix())));
        $fs->deleteDir(basename($this->getPathPrefix()));
        $fs->assertAbsent($this->getPathPrefix());
    }


}