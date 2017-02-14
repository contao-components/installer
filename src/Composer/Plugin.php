<?php

/*
 * This file is part of the Contao components installer.
 *
 * Copyright (c) 2014-2017 Leo Feyer
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
        if (!$composer->getConfig()->has('component-dir')) {
            $installer = new NoopInstaller();
        } else {
            $installer = new LibraryInstaller($io, $composer, 'contao-component');
        }

        $composer->getInstallationManager()->addInstaller($installer);
    }
}
