<?php

namespace Shopify;

use ShopifyFulfillment;

class ShopifyFulfillments extends ShopifyObjects{

	public $api;
	public $order;
	public $objectClass = '\Shopify\ShopifyFulfillment';
	public $objectType 	= 'fulfillment';
	public $objectsType = 'fulfillments';
	public $endpoint 		= '/admin/orders/{order_id}/fulfillments';


	public function initObject($object) {

		if ($object->errors) {

			$object = new $this->errorClass($this->api, $object->errors);
			return $object;

		} else if ($object) {

			$object = new $this->objectClass($this->api, ($object->{$this->objectType} ?: $object));
			$object->endpoint = str_replace("{order_id}", $this->order, $object->endpoint);
			return $object;

		} else {

			return false;

		}

	}

}
