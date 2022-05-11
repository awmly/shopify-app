<?php

namespace Shopify;

class ShopifyWebhook extends ShopifyObject{

  public $objectType  = 'webhook';
  public $endpoint    = '/admin/webhooks/{id}';

}
