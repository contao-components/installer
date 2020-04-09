<?php

/*
 * This file is part of Contao.
 *
 * (c) Leo Feyer
 *
 * @license LGPL-3.0-or-later
 */

namespace Contao\ComponentsInstaller\Test\Composer;

use Contao\ComponentsInstaller\Composer\NoopInstaller;
use Contao\ComponentsInstaller\Test\TestCase;

class NoopInstallerTest extends TestCase
{
    public function testSupportsContaoComponents()
    {
        $installer = new NoopInstaller();

        $this->assertTrue($installer->supports('contao-component'));
        $this->assertFalse($installer->supports('symfony-bundle'));
    }
}
