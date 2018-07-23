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
use Composer\Package\RootPackage;

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
        $composer->setInstallationManager(new InstallationManager());
        $composer->setConfig($config);
        $composer->setPackage($package);

        return $composer;
    }
}
