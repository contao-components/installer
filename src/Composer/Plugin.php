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
use Composer\Installer\InstallerInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class Plugin implements PluginInterface
{
    /**
     * @var InstallerInterface
     */
    private $installer;

    public function activate(Composer $composer, IOInterface $io)
    {
        if ($componentDir = $this->hasComponentDir($composer, $io)) {
            $this->installer = new LibraryInstaller($io, $composer, 'contao-component');
        } else {
            $this->installer = new NoopInstaller();
        }

        $composer->getInstallationManager()->addInstaller($this->installer);
    }

    public function deactivate(Composer $composer, IOInterface $io)
    {
        $composer->getInstallationManager()->removeInstaller($this->installer);
    }

    public function uninstall(Composer $composer, IOInterface $io)
    {
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

        $config = $composer->getConfig();

        if ($config->has('contao-component-dir')) {
            throw new \RuntimeException('Found the "contao-component-dir" key in the "config" section. Did you mean to put it into the "extra" section?');
        }

        if (!$config->has('component-dir')) {
            return false;
        }

        $io->write('<warning>Using config.component-dir has been deprecated. Please use extra.contao-component-dir instead.</warning>');

        return true;
    }
}
