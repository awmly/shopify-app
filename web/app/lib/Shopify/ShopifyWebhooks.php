<?php

namespace Shopify;

class ShopifyWebhooks extends ShopifyObjects{

	public $api;
	public $objectClass = '\Shopify\ShopifyWebhook';
	public $objectType 	= 'webhook';
	public $objectsType = 'webhooks';
	public $endpoint 		= '/admin/webhooks';

}
