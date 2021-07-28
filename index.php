<?php

date_default_timezone_set('Europe/Moscow');
require_once __DIR__ . '/core/const.php';
require_once ROOT . '/vendor/autoload.php';

use core\Router;
use \core\base\ND\ND;
ND::services();
Router::run($_SERVER['REQUEST_URI']);

