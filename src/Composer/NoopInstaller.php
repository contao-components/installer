<?php

/*
 * This file is part of Contao.
 *
 * (c) Leo Feyer
 *
 * @license LGPL-3.0-or-later
 */

namespace Contao\ComponentsInstaller\Composer;

use Composer\Installer\NoopInstaller as ComposerNoopInstaller;

class NoopInstaller extends ComposerNoopInstaller
{
    public function supports($packageType)
    {
        return 'contao-component' === $packageType;
    }
}
