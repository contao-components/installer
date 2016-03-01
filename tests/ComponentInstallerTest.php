<?php

/*
 * This file is part of the Contao components installer.
 *
 * Copyright (c) 2014-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\Composer\Test;

use Composer\Composer;
use Composer\Config;
use Composer\IO\NullIO;
use Composer\Package\Package;
use Contao\Composer\ComponentInstaller;

/**
 * Tests the ComponentInstaller class.
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class ComponentInstallerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ComponentInstaller
     */
    protected $installer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $config = new Config();

        $config->merge(
            [
                'config' => [
                    'vendor-dir'    => 'vendor',
                    'component-dir' => 'assets',
                ],
            ]
        );

        $composer = new Composer();
        $composer->setConfig($config);

        $this->installer = new ComponentInstaller(new NullIO(), $composer);
    }

    /**
     * Tests the object instantiation.
     */
    public function testInstantiation()
    {
        $this->assertInstanceOf('Contao\Composer\ComponentInstaller', $this->installer);
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
