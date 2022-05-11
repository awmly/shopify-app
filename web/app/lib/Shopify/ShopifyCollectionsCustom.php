<?php

namespace Shopify;

class ShopifyCollectionsCustom extends ShopifyObjects{

	public $type;
	public $objectClass 	= '\Shopify\ShopifyCollectionCustom';
	public $objectType 		= 'custom_collection';
	public $objectsType 	= 'custom_collections';
	public $endpoint		 	= '/admin/custom_collections';

}
