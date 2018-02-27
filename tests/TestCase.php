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

abstract class TestCase extends \PHPUnit_Framework_TestCase
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
                    'component-dir' => 'assets',
                ],
            ]
        );

        $composer = new Composer();
        $composer->setInstallationManager(new InstallationManager());
        $composer->setConfig($config);

        return $composer;
    }
}
