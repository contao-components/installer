<?php

/*
 * This file is part of the Contao components installer.
 *
 * Copyright (c) 2014-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\ComponentsInstaller\Test\Composer;

use Composer\IO\NullIO;
use Composer\Package\Package;
use Contao\ComponentsInstaller\Composer\LibraryInstaller;
use Contao\ComponentsInstaller\Test\TestCase;

/**
 * Tests the LibraryInstaller class.
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class LibraryInstallerTest extends TestCase
{
    /**
     * @var LibraryInstaller
     */
    protected $installer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->installer = new LibraryInstaller(new NullIO(), $this->getComposer(), 'contao-component');
    }

    /**
     * Tests the object instantiation.
     */
    public function testInstantiation()
    {
        $this->assertInstanceOf('Contao\ComponentsInstaller\Composer\LibraryInstaller', $this->installer);
    }

    /**
     * Tests the supports() method.
     */
    public function testSupports()
    {
        $this->assertTrue($this->installer->supports('contao-component'));
        $this->assertFalse($this->installer->supports('symfony-bundle'));
    }

    /**
     * Tests the getInstallPath() method.
     */
    public function testGetInstallPath()
    {
        $package = new Package('contao-components/installer', '~1.0', '1.0.0');

        $this->assertEquals('assets/installer', $this->installer->getInstallPath($package));
    }
}
