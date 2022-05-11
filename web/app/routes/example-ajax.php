<?php

header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: content-type, if-none-match, authorization");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Origin: *");

// Get data from post
$data = file_get_contents('php://input');

// Decode data
$data = json_decode($data);

// Set shop
$shopify = new \App\Shopify($data->shop);

// Init shopify API
$shopify->init();

// Check shop is valid
if (!$shopify->installed()) exit('Shop not installed');
