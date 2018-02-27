<?php

/*
 * This file is part of Contao.
 *
 * (c) Leo Feyer
 *
 * @license LGPL-3.0-or-later
 */

namespace Contao\ComponentsInstaller\Composer;

use Composer\Installer\LibraryInstaller as ComposerLibraryInstaller;
use Composer\Package\PackageInterface;

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
