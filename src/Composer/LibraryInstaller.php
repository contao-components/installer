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
    public function getInstallPath(PackageInterface $package)
    {
        return $this->getComponentDir().'/'.basename($package->getPrettyName());
    }

    /**
     * @return string
     */
    private function getComponentDir()
    {
        $extra = $this->composer->getPackage()->getExtra();

        if (isset($extra['contao-component-dir'])) {
            return $extra['contao-component-dir'];
        }

        if ($this->composer->getConfig()->has('component-dir')) {
            return $this->composer->getConfig()->get('component-dir');
        }

        throw new \RuntimeException('The Contao component directory is not defined!');
    }
}
