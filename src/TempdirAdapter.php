<?php

namespace Emgag\Flysystem;

use League\Flysystem\Filesystem;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\UnableToCreateDirectory;
use League\Flysystem\UnableToDeleteDirectory;

class TempdirAdapter extends LocalFilesystemAdapter
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $prefix;

    /**
     * @var string|null
     */
    private $dir;

    /**
     * @var bool
     */
    private $destruct;

    /**
     * Creates a temporary directory.
     *
     * @param string $prefix
     * @param null   $dir
     * @param bool   $destruct
     */
    public function __construct($prefix = '', $dir = null, $destruct = true)
    {
        $maxTries = 1024;

        if (empty($dir)) {
            $dir = sys_get_temp_dir();
        } else {
            $dir = rtrim($dir, DIRECTORY_SEPARATOR);
        }

        do {
            $path = $dir . DIRECTORY_SEPARATOR . uniqid($prefix, true);

            if (!file_exists($path) && mkdir($path, 0700)) {
                break;
            }

            --$maxTries;
        } while ($maxTries > 0);

        if ($maxTries == 0) {
            throw new UnableToCreateDirectory("Couldn't create temporary directory, giving up");
        }

        $this->path     = $path;
        $this->prefix   = $prefix;
        $this->dir      = $dir;
        $this->destruct = $destruct;

        parent::__construct($path);
    }

    /**
     * Returns filesystem path to temporary directory.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Removes temporary directory.
     */
    public function __destruct()
    {
        if (!$this->destruct) {
            return;
        }

        $fs = new Filesystem(new LocalFilesystemAdapter(dirname($this->path)));
        $fs->deleteDirectory(basename($this->path));

        if ($fs->fileExists(basename($this->path))) {
            throw new UnableToDeleteDirectory(sprintf('Unable to remove directory %s', $this->path));
        }
    }
}
