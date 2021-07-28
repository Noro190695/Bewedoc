<?php
use core\Router;


Router::route('^$', ['controller' => 'Main', 'action' => 'index']);
$res = Router::route('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');