<?php

/*
 * This file is part of the Contao components installer.
 *
 * Copyright (c) 2014-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */

error_reporting(E_ALL);

$include = function ($file) {
    return file_exists($file) ? include $file : false;
};

if (
    false === ($loader = $include(__DIR__.'/../vendor/autoload.php'))
    && false === ($loader = $include(__DIR__.'/../../../autoload.php'))
) {
    echo 'You must set up the project dependencies, run the following commands:'.PHP_EOL
        .'curl -sS https://getcomposer.org/installer | php'.PHP_EOL
        .'php composer.phar install'.PHP_EOL;

    exit(1);
}

return $loader;
