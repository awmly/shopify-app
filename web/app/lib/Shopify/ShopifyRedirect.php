<?php

namespace Shopify;

use Helpers;

class ShopifyRedirect extends ShopifyObject{

  public $objectType  = 'redirect';
  public $endpoint    = '/admin/redirects/{id}';

}
