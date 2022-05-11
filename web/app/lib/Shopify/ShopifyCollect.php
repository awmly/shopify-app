<?php

namespace Shopify;

use Helpers;

class ShopifyCollect extends ShopifyObject{

  public $objectType  = 'collect';
  public $endpoint    = '/admin/collects/{id}';

}
