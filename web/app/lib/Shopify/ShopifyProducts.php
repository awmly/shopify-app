<?php

namespace Shopify;

use ShopifyProduct;

class ShopifyProducts extends ShopifyObjects{

	public $api;
	public $objectClass = '\Shopify\ShopifyProduct';
	public $objectType 	= 'product';
	public $objectsType = 'products';
	public $endpoint 		= '/admin/products';


}
