<?php

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    // Database Config
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'biomap');
    define('DB_USER', 'root');
    define('DB_PASS', '');

    define('ROOT', 'http://localhost/web_project/public');
}

define('APP_NAME', 'Web_Project');
define('APP_DESC', 'Website about creatures in Vietnam');

// True mean show errors
define('DEBUG', true);
