<?php

/*
 * This file is part of Contao.
 *
 * Copyright (c) 2014-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\ComponentsInstaller\Composer;

use Composer\Installer\NoopInstaller as ComposerNoopInstaller;

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
