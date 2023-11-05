<?php

defined('ROOTPATH') or exit('Access Denied!');

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    // Database Config
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'biomap');
    define('DB_USER', 'root');
    define('DB_PASS', '');

    define('ROOT', 'http://localhost/biomap/public');
}

define('APP_NAME', 'Biomap');
define('APP_DESC', 'Website about creatures in Vietnam');

// True mean show errors
define('DEBUG', true);
