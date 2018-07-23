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
        if ($componentDir = $this->hasComponentDir($composer, $io)) {
            $installer = new LibraryInstaller($io, $composer, 'contao-component');
        } else {
            $installer = new NoopInstaller();
        }

        $composer->getInstallationManager()->addInstaller($installer);
    }

    /**
     * @return bool
     */
    private function hasComponentDir(Composer $composer, IOInterface $io)
    {
        $extra = $composer->getPackage()->getExtra();

        if (isset($extra['contao-component-dir'])) {
            return true;
        }

        if ($composer->getConfig()->has('component-dir')) {
            $io->write('<warning>Using config.component-dir has been deprecated. Please use extra.contao-component-dir instead.</warning>');

            return true;
        }

        return false;
    }
}
