<?php

namespace Shopify;

use ShopifyProduct;

class ShopifyOrders extends ShopifyObjects{

	public $api;
	public $objectClass = '\Shopify\ShopifyOrder';
	public $objectType 	= 'order';
	public $objectsType = 'orders';
	public $endpoint 		= '/admin/orders';

}
