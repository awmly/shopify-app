<?php

namespace Shopify;

use ShopifyProduct;

class ShopifyVariants extends ShopifyObjects{

	public $api;
	public $product;
	public $objectClass = '\Shopify\ShopifyVariant';
	public $objectType 	= 'variant';
	public $objectsType = 'variants';
	public $endpoint 		= '/admin/products/{product_id}/variants';

}
