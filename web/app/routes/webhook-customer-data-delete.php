<?php

$shop = $_SERVER['HTTP_X_SHOPIFY_SHOP_DOMAIN'];
$hmac = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];

$data = file_get_contents('php://input');

if (!\Shopify\Helpers::validateWebhook($hmac, $data)) exit;
