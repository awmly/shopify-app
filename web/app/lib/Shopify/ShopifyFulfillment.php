<?php

namespace Shopify;

class ShopifyFulfillment extends ShopifyObject{

  public $objectType  = 'fulfillment';
  public $objectsType  = 'fulfillments';
  public $endpoint    = '/admin/orders/{order_id}/fulfillments/{id}';

}
