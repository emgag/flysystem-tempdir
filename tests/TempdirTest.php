<?php

use Emgag\Flysystem\Tempdir;
use PHPUnit\Framework\TestCase;

class TempdirTest extends TestCase
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
