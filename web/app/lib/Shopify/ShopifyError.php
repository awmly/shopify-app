<?php

namespace Shopify;

class ShopifyError extends ShopifyObject{

  public $isError = true;

  public function displayErrors() {

    print_r($this->object);

  }

}
