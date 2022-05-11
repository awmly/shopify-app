<?php

// Bootstrap
include($_SERVER['DOCUMENT_ROOT'] . '/../app/bootstrap.php');

// Check config was loaded correctly
if (!defined('APP_URL')) exit('Config not loaded');

// Check tokens can be created
if (!is_writable(PATH_TOKENS)) exit('Tokens dir not writeable');

// Init app
$app = new App\Core();

// Dispatch
$app->load();
