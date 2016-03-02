<?php

/*
 * This file is part of the Contao components installer.
 *
 * Copyright (c) 2014-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\ComponentsInstaller\Test\Composer;

use Composer\IO\NullIO;
use Composer\Package\Package;
use Contao\ComponentsInstaller\Composer\Installer;
use Contao\ComponentsInstaller\Test\TestCase;

/**
 * Tests the Installer class.
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class InstallerTest extends TestCase
{
    /**
     * @var Installer
     */
    protected $installer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->installer = new Installer(new NullIO(), $this->getComposer(), 'contao-component');
    }

    /**
     * Tests the object instantiation.
     */
    public function testInstantiation()
    {
        $this->assertInstanceOf('Contao\ComponentsInstaller\Composer\Installer', $this->installer);
    }

    /**
     * Tests the supports() method.
     */
    public function testSupports()
    {
        $this->assertTrue($this->installer->supports('contao-component'));
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
