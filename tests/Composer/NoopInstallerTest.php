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
    /**
     * @var NoopInstaller
     */
    protected $installer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->installer = new NoopInstaller();
    }

    public function testCanBeInstantiated()
    {
        $this->assertInstanceOf('Contao\ComponentsInstaller\Composer\NoopInstaller', $this->installer);
    }

    public function testSupportsContaoComponents()
    {
        $this->assertTrue($this->installer->supports('contao-component'));
        $this->assertFalse($this->installer->supports('symfony-bundle'));
    }
}
