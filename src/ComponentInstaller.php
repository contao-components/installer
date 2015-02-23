<?php

/**
 * This file is part of the Contao components installer.
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\Composer;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

/**
 * Overrides the install path for Contao components.
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class ComponentInstaller extends LibraryInstaller
{
    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
      return 'contao-component' === $packageType;
    }

    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        $config       = $this->composer->getConfig();
        $componentDir = $config->has('component-dir') ? $config->get('component-dir') : 'components';

        return $componentDir . '/' . basename($package->getPrettyName());
    }
}
