<?php
require_once __DIR__ . '/../switchrouter.php';

$uri = trim($_SERVER['REQUEST_URI'], '/');

$router = new SwitchRouter();
$router->route($uri);