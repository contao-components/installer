<?php

/*
 * This file is part of the Contao components installer.
 *
 * Copyright (c) 2014-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\ComponentsInstaller\Test;

use Composer\Composer;
use Composer\Config;
use Composer\Installer\InstallationManager;

/**
 * Abstract TestCase class.
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Returns a Composer object.
     *
     * @return Composer The Composer object
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
