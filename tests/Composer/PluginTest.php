<?php

/*
 * This file is part of Contao.
 *
 * Copyright (c) 2014-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\ComponentsInstaller\Test\Composer;

use Composer\Config;
use Composer\IO\NullIO;
use Contao\ComponentsInstaller\Composer\Plugin;
use Contao\ComponentsInstaller\Test\TestCase;

class PluginTest extends TestCase
{
    public function testCanBeInstantiated()
    {
        $this->assertInstanceOf('Contao\ComponentsInstaller\Composer\Plugin', new Plugin());
    }

    public function testAddsTheInstallerUponActivation()
    {
        $composer = $this->getComposer();

        $plugin = new Plugin();
        $plugin->activate($composer, new NullIO());

        $installer = $composer->getInstallationManager()->getInstaller('contao-component');

        $this->assertInstanceOf('Contao\ComponentsInstaller\Composer\LibraryInstaller', $installer);
    }

    public function testAddsTheNoopInstallerIfThereIsNoComponentDir()
    {
        $config = new Config();

        $config->merge(
            [
                'config' => [
                    'vendor-dir' => 'vendor',
                ],
            ]
        );

        $composer = $this->getComposer();
        $composer->setConfig($config);

        $plugin = new Plugin();
        $plugin->activate($composer, new NullIO());

        $installer = $composer->getInstallationManager()->getInstaller('contao-component');

        $this->assertInstanceOf('Contao\ComponentsInstaller\Composer\NoopInstaller', $installer);
    }
}
