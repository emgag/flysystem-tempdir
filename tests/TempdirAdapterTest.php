<?php

use Emgag\Flysystem\TempdirAdapter as Tempdir;
use League\Flysystem\Filesystem;
use PHPUnit\Framework\TestCase;

class TempdirAdapterTest extends TestCase
{
    /**
     * @dataProvider adapterProvider
     */
    public function testHasCreated($filesystem, $adapter)
    {
        $dir = $adapter->getPath();
        self::assertTrue(is_dir($dir));
    }

    public function testIsRemoved()
    {
        $adapter    = new Tempdir();
        $filesystem = new Filesystem($adapter);
        $dir        = $adapter->getPath();

        unset($filesystem, $adapter);
        self::assertTrue(!file_exists($dir));
    }

    public function adapterProvider()
    {
        $adapter    = new Tempdir();
        $filesystem = new Filesystem($adapter);

        return [
            [$filesystem, $adapter],
        ];
    }
}
