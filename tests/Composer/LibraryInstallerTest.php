<?php

/*
 * This file is part of Contao.
 *
 * (c) Leo Feyer
 *
 * @license LGPL-3.0-or-later
 */

namespace Contao\ComponentsInstaller\Test\Composer;

use Composer\IO\NullIO;
use Composer\Package\Package;
use Contao\ComponentsInstaller\Composer\LibraryInstaller;
use Contao\ComponentsInstaller\Test\TestCase;

class LibraryInstallerTest extends TestCase
{
    /**
     * @var LibraryInstaller
     */
    protected $installer;

    protected function setUp()
    {
        $this->installer = new LibraryInstaller(new NullIO(), $this->getComposer(), 'contao-component');
    }

    public function testSupportsContaoComponents()
    {
        $this->assertTrue($this->installer->supports('contao-component'));
        $this->assertFalse($this->installer->supports('symfony-bundle'));
    }

    public function testReturnsTheInstallPath()
    {
        $package = new Package('contao-components/installer', '^1.0', '1.0.0');

        $this->assertSame('assets/installer', $this->installer->getInstallPath($package));
    }
}
