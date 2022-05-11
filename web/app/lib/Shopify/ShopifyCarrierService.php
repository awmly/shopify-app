<?php

namespace Shopify;

use Helpers;

class ShopifyCarrierService extends ShopifyObject{

  public $objectType  = 'carrier_service';
  public $endpoint    = '/admin/carrier_services/{id}';

}
