<?php

$get    = \App\Requests::get();

$state  = $get->state;
$shop   = $get->shop;
$code   = $get->code;

if ($state == \Shopify\Helpers::generateHash($shop) && \Shopify\Helpers::validateHMAC($_GET)) {

  $shopify = new \App\Shopify($shop);

  // Save token
  $shopify->saveToken($code);

  // Connect to shopify api
  $shopify->init();

  // Delete any previous script tags
  $shopify->deleteScriptTags();

  // Install script tag
  $shopify->installScriptTag([
    "event"         => "onload",
    "src"           => SCRIPT_TAG_URL,
    'display_scope' => 'all'
  ]);


  // Wait 3 seconds before going to dashboard, so script tag can be read
  sleep(3);

  // Go to dashboard
  header("Location: " . APP_URL . APP_PATH . "/dashboard?shop=" . $shop);
  exit;

}
