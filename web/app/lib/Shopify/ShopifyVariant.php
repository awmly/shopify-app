<?php

namespace Shopify;

class ShopifyVariant extends ShopifyObject{

  public $objectType  = 'variant';
  public $objectsType  = 'variants';
  public $endpoint    = '/admin/variants/{id}';

}
