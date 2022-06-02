<?php

namespace Emgag\Flysystem;

use League\Flysystem\Filesystem;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\UnableToCreateDirectory;
use League\Flysystem\UnableToDeleteDirectory;

class TempdirAdapter extends LocalFilesystemAdapter
{
    private string $path;

    private string $prefix;

    private ?string $dir;

    private bool $destruct;

    /**
     * Creates a temporary directory.
     */
    public function __construct(string $prefix = '', ?string $dir = null, bool $destruct = true)
    {
        $maxTries = 1024;

        $dir = empty($dir) ? sys_get_temp_dir() : rtrim($dir, DIRECTORY_SEPARATOR);

        do {
            $path = $dir . DIRECTORY_SEPARATOR . uniqid($prefix, true);

            if (!file_exists($path) && mkdir($path, 0700) && is_dir($path)) {
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
     */
    public function getPath(): string
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
