<?php


use Emgag\Flysystem\Tempdir;

class TempdirTest extends PHPUnit_Framework_TestCase
{

    public function testCreateAndDestroy()
    {

        $fs  = new Tempdir();
        $dir = $fs->getPath();

        $this->assertTrue(is_dir($dir));

        unset($fs);

        $this->assertTrue(!file_exists($dir));
    }


}
