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
use Contao\ComponentsInstaller\Composer\LibraryInstaller;
use Contao\ComponentsInstaller\Composer\NoopInstaller;
use Contao\ComponentsInstaller\Composer\Plugin;
use Contao\ComponentsInstaller\Test\TestCase;

class PluginTest extends TestCase
{
    public function testAddsAndRemovesTheInstaller()
    {
        $composer = $this->getComposer();

        $plugin = new Plugin();
        $plugin->activate($composer, new NullIO());

        $installer = $composer->getInstallationManager()->getInstaller('contao-component');

        $this->assertInstanceOf(LibraryInstaller::class, $installer);

        $plugin->deactivate($composer, new NullIO());

        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage('Unknown installer type: contao-component');

        $composer->getInstallationManager()->getInstaller('contao-component');
    }

    public function testAddsTheNoopInstallerIfThereIsNoComponentDir()
    {
        $composer = $this->getComposer();
        $composer->setPackage(new RootPackage('foo', '1.0.0.0', '1.0.0'));

        $plugin = new Plugin();
        $plugin->activate($composer, new NullIO());

        $installer = $composer->getInstallationManager()->getInstaller('contao-component');

        $this->assertInstanceOf(NoopInstaller::class, $installer);
    }

    public function testShowsAWarningIfTheOldConfigurationIsUsed()
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

        $this->assertInstanceOf(LibraryInstaller::class, $installer);
    }

    public function testFailsIfTheNewConfigurationIsUsedInTheWrongSection()
    {
        $config = new Config();
        $config->merge(
            [
                'config' => [
                    'contao-component-dir' => 'assets',
                    'vendor-dir' => 'vendor',
                ],
            ]
        );

        $composer = $this->getComposer();
        $composer->setConfig($config);
        $composer->getPackage()->setExtra([]);

        $plugin = new Plugin();

        $this->expectException('RuntimeException');
        $this->expectExceptionMessage('Found the "contao-component-dir" key in the "config" section. Did you mean to put it into the "extra" section?');

        $plugin->activate($composer, $this->createMock(ConsoleIO::class));
    }
}
