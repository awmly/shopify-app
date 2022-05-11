<?php

$get      = \App\Requests::get();

$shop     = $get->shop;
$scopes   = SHOPIFY_SCOPES;
$nonce    = \Shopify\Helpers::generateHash($shop);
$redirect = APP_URL . APP_PATH . '/install-complete';

$shopify  = new \App\Shopify($shop);

$shopify->init();

if ($shopify->installed()) {

  $queryString = \Shopify\Helpers::generateHMAC([
    'time'  => time(),
    'shop'  => $shop
  ]);

  $url = APP_URL . APP_PATH . '/dashboard?' . $queryString;

} else {

  $url = 'https://' . $shop . '/admin/oauth/authorize?client_id=' . SHOPIFY_KEY . '&scope=' . $scopes . '&redirect_uri=' . $redirect . '&state=' . $nonce;

}

header("Location: " . $url);
exit;
