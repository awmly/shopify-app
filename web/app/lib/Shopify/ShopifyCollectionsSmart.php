<?php

namespace Shopify;

class ShopifyCollectionsSmart extends ShopifyObjects{

	public $type;
	public $objectClass 	= '\Shopify\ShopifyCollectionSmart';
	public $objectType 		= 'smart_collection';
	public $objectsType 	= 'smart_collections';
	public $endpoint		 	= '/admin/smart_collections';

}
