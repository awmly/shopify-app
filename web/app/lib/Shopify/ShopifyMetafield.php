<?php

namespace Shopify;

class ShopifyMetafield extends ShopifyObject{

  public $objectType  = 'metafield';
  public $endpoint    = '/admin/metafields/{id}';

}
