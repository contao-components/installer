Contao components installer
===========================

[![](https://img.shields.io/packagist/v/contao-components/installer.svg?style=flat-square)](https://packagist.org/packages/contao-components/installer)
[![](https://img.shields.io/packagist/dt/contao-components/installer.svg?style=flat-square)](https://packagist.org/packages/contao-components/installer)

Contao is an Open Source PHP Content Management System for people who want a
professional website that is easy to maintain. Visit the [project website][1]
for more information.


About
-----

This custom Composer installer handles packages with the type attribute set to
"contao-component" and installs them into a separate directory.


Usage
-----

To create a [Contao component][2], add the following to your `composer.json`:

```json
{
    "name": "vendor/name",
    "type": "contao-component",
    "license": "LGPL-3.0-or-later",
    "require": {
        "contao-components/installer": "^1.0"
    }
}
```


Component directory
-------------------

By default, the components will be installed into a `components/` directory.
To change the installation directory, add the following to the `composer.json`
file of your project:

```json
{
    "extra": {
        "contao-component-dir": "assets"
    }
}
```


[1]: https://contao.org
[2]: https://github.com/contao-components
