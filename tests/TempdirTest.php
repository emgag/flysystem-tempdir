<?php

use Emgag\Flysystem\Tempdir;
use PHPUnit\Framework\TestCase;

class TempdirTest extends TestCase
{
    public function testCreateAndDestroy()
    {
        $fs  = new Tempdir();
        $dir = $fs->getPath();

        self::assertTrue(is_dir($dir));

        unset($fs);

        self::assertTrue(!file_exists($dir));
    }
}
