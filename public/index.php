<?php

session_start();

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';

require_once CORE_PATH . 'Database.php';
require_once CORE_PATH . 'Model.php';
require_once CORE_PATH . 'Controller.php';
require_once CORE_PATH . 'App.php';
require_once APP_PATH . 'core/Auth.php';
require_once APP_PATH . 'core/Pagination.php';
require_once APP_PATH . 'core/Logger.php';

$app = new App();
