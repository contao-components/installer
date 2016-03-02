<?php

/*
 * This file is part of the Contao components installer.
 *
 * Copyright (c) 2014-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\ComponentsInstaller\Test\Composer;

use Composer\IO\NullIO;
use Contao\ComponentsInstaller\Composer\Plugin;
use Contao\ComponentsInstaller\Test\TestCase;

/**
 * Tests the Plugin class.
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class PluginTest extends TestCase
{
    /**
     * Tests the object instantiation.
     */
    public function testInstantiation()
    {
        $this->assertInstanceOf('Contao\ComponentsInstaller\Composer\Plugin', new Plugin());
    }

    /**
     * Tests the activate() method.
     */
    public function testActivate()
    {
        $composer = $this->getComposer();

        $plugin = new Plugin();
        $plugin->activate($composer, new NullIO());

        $this->assertInstanceOf(
            'Contao\ComponentsInstaller\Composer\Installer',
            $composer->getInstallationManager()->getInstaller('contao-component')
        );
    }
}
