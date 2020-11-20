<?php
// set the application folder
define('APP_PATH', __DIR__ . '/');

// set the debug mode
define('APP_DEBUG', true);

// load the framework file
require(APP_PATH . 'simplemvc/Simplemvc.php');

// load the config file
$config = require(APP_PATH . 'config/config.php');

//
(new simplemvc\Simplemvc($config))->run();
