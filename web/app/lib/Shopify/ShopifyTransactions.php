<?php

namespace Shopify;

use ShopifyTransaction;

class ShopifyTransactions extends ShopifyObjects{

	public $api;
	public $order;
	public $objectClass = '\Shopify\ShopifyTransaction';
	public $objectType 	= 'transaction';
	public $objectsType = 'transactions';
	public $endpoint 		= '/admin/orders/{order_id}/transactions';


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
