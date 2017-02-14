<?php

/*
 * This file is part of the Contao components installer.
 *
 * Copyright (c) 2014-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\ComponentsInstaller\Composer;

use Composer\Installer\LibraryInstaller as ComposerLibraryInstaller;
use Composer\Package\PackageInterface;

/**
 * Overrides the install path for Contao components.
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class LibraryInstaller extends ComposerLibraryInstaller
{
    /**
     * {@inheritdoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        return $this->composer->getConfig()->get('component-dir').'/'.basename($package->getPrettyName());
    }
}
