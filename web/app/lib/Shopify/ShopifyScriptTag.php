<?php

namespace Shopify;

class ShopifyScriptTag extends ShopifyObject{

  public $objectType  = 'redirect';
  public $endpoint    = '/admin/script_tags/{id}';

}
