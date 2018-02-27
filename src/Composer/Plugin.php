<?php

/*
 * This file is part of Contao.
 *
 * (c) Leo Feyer
 *
 * @license LGPL-3.0-or-later
 */

namespace Contao\ComponentsInstaller\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

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
