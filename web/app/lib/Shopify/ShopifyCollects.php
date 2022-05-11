<?php

namespace Shopify;

use ShopifyProduct;

class ShopifyCollects extends ShopifyObjects{

	public $api;
	public $objectClass = '\Shopify\ShopifyCollect';
	public $objectType 	= 'collect';
	public $objectsType = 'collects';
	public $endpoint 		= '/admin/collects';

}
