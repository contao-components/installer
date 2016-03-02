<?php

/*
 * This file is part of the Contao components installer.
 *
 * Copyright (c) 2014-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\ComponentsInstaller\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

/**
 * Adds the components installer to Composer.
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class Plugin implements PluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        $composer->getInstallationManager()->addInstaller(new Installer($io, $composer, 'contao-component'));
    }
}
