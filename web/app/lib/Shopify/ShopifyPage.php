<?php

namespace Shopify;

use Helpers;

class ShopifyPage extends ShopifyObject{

  public $objectType  = 'page';
  public $objectsType  = 'pages';
  public $endpoint    = '/admin/pages/{id}';

}
