<?php

namespace App;

class Shopify {

  public function __construct($shop) {

    $this->shop = $shop;

  }


  public function init() {

    $token = file_get_contents(PATH_TOKENS . $this->shop);

    $this->shopify = new \Shopify\Shopify($this->shop, $token);

    $this->shopify->setAPI($this->shop, $token);

  }


  public function saveToken($code) {

    $token = \Shopify\Helpers::getToken($this->shop, $code);

    file_put_contents(PATH_TOKENS . $this->shop, $token->access_token);

  }


  public function deleteToken() {

    if (is_file(PATH_TOKENS . $this->shop)) {
      unlink(PATH_TOKENS . $this->shop);
    }

  }


  public function installed() {

    $json = $this->shopify->shop();

    return $json->shop->id ? true : false;

  }


  public function getScriptTags() {

    return $this->shopify->scriptTags()->search();

  }


  public function deleteScriptTags() {

    $scriptTags = $this->getScriptTags();

    foreach ($scriptTags as $scriptTag) {
      $scriptTag->delete();
    }

  }


  public function installScriptTag($scriptTag) {

    return $this->shopify->scriptTags()->add($scriptTag);

  }


  public function getOrder($id) {

    return $this->shopify->orders()->get($id);

  }


  public function getCollections($prodID) {

    $smart = $this->shopify->collections('smart');

    $smartColls = $smart->search([
      "product_id" => $prodID
    ]);

    $custom = $this->shopify->collections('custom');

    $customColls = $custom->search([
      "product_id" => $prodID
    ]);

    return array_merge($smartColls, $customColls);

  }

}
