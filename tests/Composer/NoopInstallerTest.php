<?php

/*
 * This file is part of the Contao components installer.
 *
 * Copyright (c) 2014-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\ComponentsInstaller\Test\Composer;

use Contao\ComponentsInstaller\Composer\NoopInstaller;
use Contao\ComponentsInstaller\Test\TestCase;

/**
 * Tests the NoopInstaller class.
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
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

    /**
     * Tests the object instantiation.
     */
    public function testInstantiation()
    {
        $this->assertInstanceOf('Contao\ComponentsInstaller\Composer\NoopInstaller', $this->installer);
    }

    /**
     * Tests the supports() method.
     */
    public function testSupports()
    {
        $this->assertTrue($this->installer->supports('contao-component'));
        $this->assertFalse($this->installer->supports('symfony-bundle'));
    }
}
