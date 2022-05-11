<?php

namespace Shopify;

class Request{

  public function __construct($shopDomain, $customerID = false) {

    $this->shopDomain = $shopDomain;

    $this->customerID = $customerID;

    $this->shopID = str_replace(".myshopify.com", "", $this->shopDomain);

  }

  public function error($msg) {

    $this->feedback('Error: ' . $msg);

  }

  public function feedback($msg) {

    $this->errorCode .= "CXL > " . $msg . "\n\n";

  }

  public function validateHash($fields = false) {

    $token = $this->shop->hmac;

    $options = $_POST;

    $string = '';

    ksort($options);

    foreach ($options as $key => $value) {

      //$this->feedback($key . " = " . $value);

      if ($key == 'hash') {

        $hash = $value;

      }else {

        $validate = false;

        if (is_array($fields)) {
          if (in_array($key, $fields)) {
            $validate = true;
          }
        } else {
          $validate = true;
        }

        if ($validate) {
          if ($string) $string .= "&";
          $string .= $key."=".$value;
        }

      }

    }

    if ($hash != hash_hmac('sha256' , $string, $token, false)) {
      $this->error('HMAC failed');
      return false;
    }

    return true;

  }

  public function getCustomer() {

    $customers = STAN::Shopify()->customers();
    $customer = $customers->get($this->customerID);

    if ($customer && !$customer->isError) {

      // Set customer object
      $this->customer = $customer;
      return true;

    } else {

      $this->error('Customer not found');
      return false;

    }

  }


  public function getShop() {

    $this->shop = Item($this->shopID, 'title', 'users');

    if (!$this->shop) {
      $this->error('Shop '.$this->shopID.' not found');
      return false;
    }

    Register('User', $this->shop);

    STAN::Shopify()->setAPI($this->shopDomain, $this->shop->token);

    $this->shopObj = STAN::Shopify()->shop()->get();

    if ($this->shop->config_id) {
      $this->appConfig = Item('app-config:' . $this->shop->config_id);
    }

    return true;

  }

  public function checkTimestamp($timestamp) {

    if ($timestamp + 1800 < time()) {
      $this->error('Request expired');
      return false;
    }

    return true;

  }

  public function checkReferer() {

    if (!strstr($_SERVER['HTTP_REFERER'], $this->shopObj->domain) && !strstr($_SERVER['HTTP_REFERER'], $this->shopObj->myshopify_domain)) {
      $this->error('Referer failed'  . $_SERVER['HTTP_REFERER'] . " - " . $this->shopObj->domain . " (".$this->shopObj->myshopify_domain.")");
      return false;
    }

    return true;

  }

}
