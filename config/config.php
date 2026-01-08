<?php
define('BASE_URL', 'http://localhost/qlns-php-thuan/');

define('APP_PATH', dirname(__DIR__) . '/app/');
define('CORE_PATH', dirname(__DIR__) . '/core/');
define('PUBLIC_PATH', dirname(__DIR__) . '/public/');

define('SESSION_NAME', 'QLNS_SESSION');
define('SESSION_TIMEOUT', 3600); // 1 hour

date_default_timezone_set('Asia/Ho_Chi_Minh');

error_reporting(E_ALL);
ini_set('display_errors', 1);
