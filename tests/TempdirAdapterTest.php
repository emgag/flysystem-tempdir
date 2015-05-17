<?php


use Emgag\Flysystem\TempdirAdapter as Tempdir;
use League\Flysystem\Filesystem;

class TempdirAdapterTest extends PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider adapterProvider
     */
    public function testHasCreated($filesystem, $adapter)
    {
        $dir = $adapter->getPathPrefix();
        $this->assertTrue(is_dir($dir));
    }


    public function testIsRemoved()
    {
        $adapter    = new Tempdir();
        $filesystem = new Filesystem($adapter);
        $dir        = $adapter->getPathPrefix();

        unset($filesystem, $adapter);
        $this->assertTrue(!file_exists($dir));
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
