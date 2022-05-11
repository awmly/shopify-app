<?php

namespace Shopify;

use ShopifyProduct;

class ShopifyPages extends ShopifyObjects{

	public $api;
	public $objectClass = '\Shopify\ShopifyPage';
	public $objectType 	= 'page';
	public $objectsType = 'pages';
	public $endpoint 		= '/admin/pages';

}
