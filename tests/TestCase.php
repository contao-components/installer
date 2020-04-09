<?php

/*
 * This file is part of Contao.
 *
 * (c) Leo Feyer
 *
 * @license LGPL-3.0-or-later
 */

namespace Contao\ComponentsInstaller\Test;

use Composer\Composer;
use Composer\Config;
use Composer\Installer\InstallationManager;
use Composer\IO\NullIO;
use Composer\Package\RootPackage;
use Composer\Util\Loop;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * Returns a Composer object.
     *
     * @return Composer
     */
    protected function getComposer()
    {
        $config = new Config();

        $config->merge(
            [
                'config' => [
                    'vendor-dir' => 'vendor',
                ],
            ]
        );

        $package = new RootPackage('foobar', '1.0.0.0', '1.0.0');
        $package->setExtra(['contao-component-dir' => 'assets']);

        $composer = new Composer();
        $composer->setInstallationManager($this->getInstallationManager());
        $composer->setConfig($config);
        $composer->setPackage($package);

        return $composer;
    }

    /**
     * @return InstallationManager
     */
    private function getInstallationManager()
    {
        if (!class_exists(Loop::class)) {
            return new InstallationManager(); // Composer v1
        }

        return new InstallationManager($this->createMock(Loop::class), new NullIO()); // Composer v2
    }
}
