<?php

namespace Shopify;

use Helpers;

class ShopifyOrder extends ShopifyObject{

  public $objectType  = 'order';
  public $endpoint    = '/admin/orders/{id}';

  public function fulfillments() {

    if (!$this->fulfillmentsObj) {
      $this->fulfillmentsObj = new ShopifyFulfillments($this->api);
      $this->fulfillmentsObj->order 	= $this->object->id;
  		$this->fulfillmentsObj->endpoint = str_replace("{order_id}", $this->object->id, $this->fulfillmentsObj->endpoint);
    }

    return $this->fulfillmentsObj;

  }

  public function transactions() {

    if (!$this->transactionsObj) {
      $this->transactionsObj = new ShopifyTransactions($this->api);
      $this->transactionsObj->order 	= $this->object->id;
  		$this->transactionsObj->endpoint = str_replace("{order_id}", $this->object->id, $this->transactionsObj->endpoint);
    }

    return $this->transactionsObj;

  }

}
