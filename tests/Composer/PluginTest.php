<?php

/*
 * This file is part of Contao.
 *
 * (c) Leo Feyer
 *
 * @license LGPL-3.0-or-later
 */

namespace Contao\ComponentsInstaller\Test\Composer;

use Composer\Config;
use Composer\IO\ConsoleIO;
use Composer\IO\NullIO;
use Composer\Package\RootPackage;
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
        $composer = $this->getComposer();
        $composer->setPackage(new RootPackage('foo', '1.0.0.0', '1.0.0'));

        $plugin = new Plugin();
        $plugin->activate($composer, new NullIO());

        $installer = $composer->getInstallationManager()->getInstaller('contao-component');

        $this->assertInstanceOf('Contao\ComponentsInstaller\Composer\NoopInstaller', $installer);
    }

    public function testA()
    {
        $config = new Config();
        $config->merge(
            [
                'config' => [
                    'component-dir' => 'assets',
                    'vendor-dir' => 'vendor',
                ],
            ]
        );

        $composer = $this->getComposer();
        $composer->setConfig($config);
        $composer->getPackage()->setExtra([]);

        $io = $this->createMock(ConsoleIO::class);
        $io
            ->expects($this->once())
            ->method('write')
            ->with('<warning>Using config.component-dir has been deprecated. Please use extra.contao-component-dir instead.</warning>')
        ;

        $plugin = new Plugin();
        $plugin->activate($composer, $io);

        $installer = $composer->getInstallationManager()->getInstaller('contao-component');

        $this->assertInstanceOf('Contao\ComponentsInstaller\Composer\LibraryInstaller', $installer);
    }
}
