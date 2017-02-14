<?php

/*
 * This file is part of the Contao components installer.
 *
 * Copyright (c) 2014-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\ComponentsInstaller\Composer;

use Composer\Installer\NoopInstaller as ComposerNoopInstaller;

/**
 * Overrides the install path for Contao components.
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class NoopInstaller extends ComposerNoopInstaller
{
    /**
     * {@inheritdoc}
     */
    public function supports($packageType)
    {
        return 'contao-component' === $packageType;
    }
}
