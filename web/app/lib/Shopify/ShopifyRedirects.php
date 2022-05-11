<?php

namespace Shopify;

use ShopifyProduct;

class ShopifyRedirects extends ShopifyObjects{

	public $api;
	public $objectClass = '\Shopify\ShopifyRedirect';
	public $objectType 	= 'redirect';
	public $objectsType = 'redirects';
	public $endpoint 		= '/admin/redirects';

}
