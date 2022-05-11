<?php

namespace Shopify;

class ShopifyTransaction extends ShopifyObject{

  public $objectType 	= 'transaction';
	public $objectsType = 'transactions';
  public $endpoint    = '/admin/orders/{order_id}/transactions/{id}';

}
