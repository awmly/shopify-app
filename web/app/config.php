<?php

// Set paths
define('PATH_ROOT',       $_SERVER['DOCUMENT_ROOT'] . '/');
define('PATH_APP',        PATH_ROOT . 'app/');
define('PATH_LIB',        PATH_ROOT . 'app/lib/');
define('PATH_ROUTES',     PATH_ROOT . 'app/routes/');
define('PATH_TOKENS',     PATH_ROOT . 'app/tokens/');

// Debug mode
define('DEBUG_MODE',      true);

// App URL
define('APP_URL',         'https://APP_URL');
define('APP_PATH',        '');

// Set endpoints
define('GDPR_ENDPOINT',   'https://APP_URL');

// Shopify app key/secret
define('SHOPIFY_KEY',     '');
define('SHOPIFY_SECRET',  '');

// Scropes required for our app
define('SHOPIFY_SCOPES',  '');
