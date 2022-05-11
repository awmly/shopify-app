<?php

namespace Shopify;

use ShopifyProduct;

class ShopifyCarrierServices extends ShopifyObjects{

	public $api;
	public $objectClass = '\Shopify\ShopifyCarrierService';
	public $objectType 	= 'carrier_service';
	public $objectsType = 'carrier_services';
	public $endpoint 		= '/admin/carrier_services';

}
