<?php

namespace Shopify;

class ShopifyScriptTags extends ShopifyObjects{

	public $api;
	public $objectClass = '\Shopify\ShopifyScriptTag';
	public $objectType 	= 'script_tag';
	public $objectsType = 'script_tags';
	public $endpoint 		= '/admin/script_tags';

}
