<?php
session_start();
date_default_timezone_set('Europe/Moscow');
require_once __DIR__ . '/app/config/const.php';

require_once ROOT . '/vendor/autoload.php';

use core\Router;
use \core\base\bewedoc\Bewedoc;
Bewedoc::services();
Router::run($_SERVER['REQUEST_URI']);

