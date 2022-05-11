<?php

namespace Shopify;

use ShopifyProduct;

class ShopifyCustomers extends ShopifyObjects{

	public $api;
	public $objectClass 		= '\Shopify\ShopifyCustomer';
	public $objectType 			= 'customer';
	public $objectsType 		= 'customers';
	public $endpoint 				= '/admin/customers';
	public $endpointSearch	= '/admin/customers/search';

}
