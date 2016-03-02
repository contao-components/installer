<?php

/*
 * This file is part of the Contao components installer.
 *
 * Copyright (c) 2014-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\ComponentsInstaller\Composer;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

/**
 * Overrides the install path for Contao components.
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class Installer extends LibraryInstaller
{
    /**
     * {@inheritdoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        $config = $this->composer->getConfig();
        $componentDir = $config->has('component-dir') ? $config->get('component-dir') : 'vendor/contao-components';

        return $componentDir . '/' . basename($package->getPrettyName());
    }
}